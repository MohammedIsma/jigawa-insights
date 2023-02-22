<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateCounts;
use App\Models\AccreditationResult;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            "count" => $count,
            "box_count" => $box_count,
            "user_id" => auth()->user()->id,
        ]);

        $PU->update([
            "accredited_count_1" => $count
        ]);

        UpdateCounts::dispatchSync([$PU->ward_id]);

        return redirect()->back();
    }

    public function fn_submit_results(Request $request, $pu_id)
    {
        $PU = PollingUnit::findOrFail($pu_id);
        $post = $request->all();

        foreach($post['vote_tally'] as $pid=>$tally) {
            $Result = VotingResult::updateOrCreate([
                "state_id" => 1,
                "lga_id" => $PU->lga_id,
                "ward_id" => $PU->ward_id,
                "polling_unit_id" => $PU->id,
                "political_party_id" => $pid
            ], [
                "count" => $tally,
                "user_id" => auth()->user()->id,
            ]);
        }

        UpdateCounts::dispatchSync([$PU->ward_id]);

        return redirect()->back();
    }
}
