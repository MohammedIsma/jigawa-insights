<?php

namespace App\Http\Controllers;

use App\Models\AccreditationResult;
use App\Models\LGA;
use App\Models\PoliticalParty;
use App\Models\State;
use App\Models\VotingResult;
use App\Http\Resources\LGAResource;
use App\Http\Resources\WardResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LGAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lga = LGA::withCount(['PollingUnits', 'Wards'])->get();
        if($lga){
            $state = ''; //$lga->state()->state_name;
        $lgas = array('lgas'=> LGAResource::collection($lga), 'state'=> $state);
        //return response()->json(['data'=>$lga], 200);
        return view('lga', compact('lgas'));
        }else{
            return response()->json(['message'=> 'Record not found'], 404);
        }

    }

    public function ajx_get_lgas()
    {
        $lgas = LGA::all();
        return [
            "success" => true,
            "payload" => [
                "LGAs" => LGAResource::collection($lgas),
                "time" => date("H:i:s - dM")
            ]
        ];
    }

    public function ajx_get_wards($lga_id)
    {
        $LGA = LGA::findOrFail($lga_id);
        $wards = $LGA->Wards;
        return [
            "success" => true,
            "payload" => [
                "LGA" => new LGAResource ($LGA),
                "Wards" => WardResource::collection($wards),
                "time" => date("H:i:s - dM")
            ]
        ];
    }

    public function ajx_get_lga_winners()
    {
        $LGA_Winners = [];
        foreach(LGA::all() as $lga){
            $lp = $lga->leading_party;
            $p = $lp ? PoliticalParty::find($lp->political_party_id) : null;
            $LGA_Winners[] = [
                "name" => $lga->name,
                "logo" => $lp ? $p->logo : null,
                "leading_party" => $lp ? $p->name : null,
                "leading_count" => $lp ? $lp->count : null,
            ];
        }
        return [
            "success" => true,
            "payload" => [
                "LGWinners" => $LGA_Winners,
                "time" => date("H:i:s - dM")
            ]
        ];
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
        $LGA = LGA::findOrFail($id);
        $params['LGA'] = $LGA;
        return view('lgas.show', $params);
    }

    public function showLGAByState($id)
    {

        //
        $lga = LGA::find($id);
        if($lga){
            return response()->json(['data'=> $lga]);
        }else{
            return response()->json(['message'=> 'Record not found'], 404);
        }

    }

    public function ajx_get_ward_results_tally($lga_id){
        $r = [];
        $LGA = LGA::findOrFail($lga_id);

        $Parties = PoliticalParty::whereIn(
            "id", VotingResult::where("lga_id", $lga_id)->where('count','>',0)->pluck("political_party_id")->toArray()
        )->pluck("slug")->toArray();

        foreach($LGA->Wards as $Ward) {
            $VR = VotingResult::selectRaw("political_party_id,SUM(count) as tally")
                ->where("ward_id", $Ward->id)
                ->having("tally",">",0)
                ->groupBy("political_party_id")
                ->get();

            foreach ($VR as $vr) {
                $party = getPoliticalParty($vr->political_party_id);
                $r[$Ward->id]["reported"] = $Ward->reported_percentage;
                $r[$Ward->id]["results"][$party->slug] =[
                    "ward_name" => $Ward->name,
                    "party_name" => getPoliticalParty($vr->political_party_id)->name,
                    "party_slug" => getPoliticalParty($vr->political_party_id)->slug,
                    "party_logo" => getPoliticalParty($vr->political_party_id)->logo,
                    "tally" => $vr->tally
                ];
            }
        }

        return response()->json([
            "success" => true,
            "payload" => [
                "parties" => array_unique($Parties),
                "results" => $r
            ]
        ]);
    }
}
