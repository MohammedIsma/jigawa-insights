<?php

namespace App\Http\Controllers;

use App\Jobs\SendIncidenceReport;
use App\Jobs\UpdateCounts;
use App\Models\AccreditationResult;
use App\Models\Incident;
use App\Models\Issue;
use App\Models\LGA;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\VotingResult;
use App\Models\Ward;
use Illuminate\Http\Request;

class PollingUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $unit = PollingUnit::all();
        if($unit){
            $ward = '';
            $units = array('units'=> $unit, 'ward'=> $ward);
        //return response()->json(['data'=>$unit], 200);
        return view('unit', compact('units'));
        }else{
            return response()->json(['message'=> 'Record not found'], 404);
        }
    }

    public function delete_results($puid){

        if(auth()->user()->id == 1){
            $PU = PollingUnit::findOrFail($puid);
            VotingResult::where('polling_unit_id', $puid)->delete();
            AccreditationResult::where('polling_unit_id', $puid)->delete();
            UpdateCounts::dispatch([$PU->ward_id]);
        }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $unit = PollingUnit::where('lga_id',$id)->get();
        if($unit){
            $ward = LGA::find($id);
            $units = array('units'=> $unit, 'ward'=> $ward->name);
            //return response()->json(['units'=> $unit]);
            return view('unit', compact('units'));
        }else{
            return response()->json(['message'=> 'unit not found'], 404);
        }
    }

    public function search(Request $request)
    {
        $id = $request->pu_code ?? "x";
        $PU = PollingUnit::find($id);

        if($PU){
            return redirect()->route("ward.show", $PU->ward_id);
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function submit_accreditation(Request $request, $pu_id)
    {
        $PU = PollingUnit::findOrFail($pu_id);
        $params = [
            "PU" => $PU
        ];
        return view("pu.accredit", $params);
    }

    public function fn_submit_accreditation(Request $request, $pu_id)
    {
        $PU = PollingUnit::findOrFail($pu_id);
        $post = $request->all();
        $count = $post['acc_count'];
        $box_count = $post['box_count'];
        $Result = AccreditationResult::updateOrCreate([
            "state_id" => 1,
            "lga_id" => $PU->lga_id,
            "ward_id" => $PU->ward_id,
            "polling_unit_id" => $PU->id
        ],[
            "voter_count" => $PU->voter_count,
            "accredited_count" => $count,
            "box_count" => $box_count,
            "user_id" => auth()->user()->id,
        ]);

        $PU->update([
            "accredited_count_1" => $count
        ]);

        UpdateCounts::dispatchSync([$PU->ward_id]);

        $r = route("ward.show", $PU->ward_id);
        echo '<a href="'.$r.'">Click to go back</a>';
        // return redirect()->route("ward.show", $PU->ward_id);
    }

    public function fn_submit_ward_results(Request $request, $ward_id)
    {

        $post = $request->all();

        $votes = $post['pvote'];
        foreach($votes as $puid=>$v){
            foreach ($v as $ppid=>$v){
                if($v!==null){
                    $pu = PollingUnit::find($puid);
                    VotingResult::updateOrCreate([
                        "state_id" => 1,
                        "lga_id" => $pu->lga_id,
                        "ward_id" => $pu->ward_id,
                        "political_party_id" => $ppid,
                        "polling_unit_id" => $puid,
                    ],[
                        "user_id" => auth()->user()->id,
                        "count" => $v
                    ]);
                }
            }
        }

        UpdateCounts::dispatchSync([$ward_id]);

        return redirect()->back();

    }

    public function fn_submit_results(Request $request, $pu_id)
    {
        $PU = PollingUnit::findOrFail($pu_id);
        $post = $request->all();

        $has_issue = isset($post['has_issue']) && $post['has_issue'];
        $ttl_votes = 0;

        foreach($post['vote_tally'] as $pid=>$tally) {
            $ttl_votes += $tally;
            $Result = VotingResult::updateOrCreate([
                "state_id" => 1,
                "lga_id" => $PU->lga_id,
                "ward_id" => $PU->ward_id,
                "polling_unit_id" => $PU->id,
                "political_party_id" => $pid
            ], [
                "count" => $has_issue ? 0 : $tally,
                "user_id" => auth()->user()->id,
            ]);
        }
        $pu_upd = [
            "accredited_count_1" => $ttl_votes,
        ];

        if($has_issue){
            $pu_upd["has_issue"] = true;
        }
        $PU->update($pu_upd);

        UpdateCounts::dispatchSync([$PU->ward_id]);
        $r = route("ward.show", $PU->ward_id);
        echo '<a href="'.$r.'">Successful. Click to go back</a>';
    }

    public function report_issue(Request $request, $pu_id){
        $PollingUnit = PollingUnit::find($pu_id);
        return view("pu.report_issue")->with(["PU"=>$PollingUnit]);

    }
    public function view_issues(Request $request, $pu_id){
        $PollingUnit = PollingUnit::find($pu_id);
        return view("pu.view_issues")->with(["PU"=>$PollingUnit]);

    }

    public function fn_report_issue(Request $request, $pu_id){
        $PollingUnit = PollingUnit::findOrFail($pu_id);
        $post = $request->all();
        $report = $post['issue_report'];

        $Issue = Incident::create([
            "ident" => rand(11111,99999),
            "state_id" => 1,
            "lga_id" => $PollingUnit->lga_id,
            "ward_id" => $PollingUnit->ward_id,
            "polling_unit_id" => $PollingUnit->id,
            "user_id" => auth()->user()->id,
            "description" => $report
        ]);
        $PollingUnit = $Issue->PollingUnit;

        $String = sprintf("%s\n%s\n==================\n%s LGA, %s Ward\nPUnit: %s\nDELIM: %s\nVOTERS: %d\n------------------\n%s",
            "INCIDENCE REPORT",
            $Issue->created_at->format("d M h:ia"),
            ucwords(strtolower($PollingUnit->LGA->name)),
            ucwords(strtolower($PollingUnit->Ward->name)),
            $PollingUnit->name,
            $PollingUnit->number,
            $PollingUnit->voter_count,
            $Issue->description,
        );
        echo nl2br( $String );
        echo "<br /><br /><br /><br /><br /><br />";
        echo "<a href='/states/1'>Home</a>";


    }
}
