<?php

namespace App\Http\Controllers;

use App\Http\Resources\PollingUnitResource;
use App\Models\LGA;
use App\Models\PoliticalParty;
use App\Models\VotingResult;
use App\Models\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ward = Ward::withCount('pollingUnit')->get();
        if($ward){
        //return response()->json(['data'=>$ward], 200);
        $lgas = '';
        $wards = array('wards'=> $ward, 'lgas'=> $lgas);
        return view('ward', compact('wards'));
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $Ward = Ward::findOrFail($id);
        $params['Ward'] = $Ward;
        $params['Parties'] = getPopularParties();

        $VR = VotingResult::where('ward_id', $id)->get();
        $Results = [];

        foreach($VR as $vr){
            $Results[$vr->polling_unit_id][$vr->political_party_id] = $vr->count;
        }

        $params['Results'] = $Results;
        return view('wards.show', $params);
    }

    public function wardByLGA($id)
    {

        //
        $ward = Ward::find($id);
        if($ward){
            //return response()->json(['data'=> $ward]);
            $lgas = LGA::find($id);
        $wards = array('wards'=> $ward, 'lgas'=> $lgas->local_name);
            return view('ward', compact('wards'));
        }else{
            return response()->json(['message'=> 'ward not found'], 404);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajx_get_ward_sheet($wid){
        $Ward = Ward::findOrFail($wid);
        $VR = VotingResult::where('ward_id', $wid)->get();
        $Results = [];

        $parties = getPopularParties();

        foreach ($Ward->PollingUnits as $PU){
            foreach($parties as $p){
                $Results[$PU->id][$p->id] = "";
            }
        }
        foreach($VR as $vr){
            $Results[$vr->polling_unit_id][$vr->political_party_id] = $vr->count;
        }

        return [
            "success" => true,
            "polling_units" => PollingUnitResource::collection($Ward->PollingUnits),
            "political_parties" => getPopularParties(),
            "results" => $Results,
        ];

    }

    public function ajx_submit_ward_sheet(Request $request, $ward_id){
        $post = $request->all();

        $Ward = getWard($ward_id);

        foreach($post['Results'] as $pid=>$R){
            foreach($R as $party_id=>$tally){
                if($tally==""){
                    continue;
                }
                VotingResult::updateOrCreate([
                    "state_id" => 1,
                    "lga_id" => $Ward->lga_id,
                    "ward_id" => $Ward->id,
                    "polling_unit_id" => $pid,
                    "political_party_id" => $party_id,
                ],[
                    "count" => $tally,
                    "user_id" => $post['user_id']
                ]);
            }
        }

        return response()->json([
            "success" => true,
        ]);
    }
}
