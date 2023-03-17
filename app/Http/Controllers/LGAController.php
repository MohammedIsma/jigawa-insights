<?php

namespace App\Http\Controllers;

use App\Http\Resources\PollingUnitResource;
use App\Models\AccreditationResult;
use App\Models\LGA;
use App\Models\PoliticalParty;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\VotingResult;
use App\Http\Resources\LGAResource;
use App\Http\Resources\WardResource;
use App\Models\Ward;
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
                "id" => $lga->id,
                "name" => $lga->name,
                "logo" => $lp ? $p->logo : "/image/parties/nan.jpg",
                "leading_party" => $lp ? $p->name : null,
                "leading_count" => $lp ? $lp->count : null,
            ];
        }

        $reported_pus = DB::table('voting_results')->distinct('polling_unit_id')->count('polling_unit_id');

        $apcvotes = VotingResult::where('political_party_id', 7)->sum('count');
        $pdpvotes = VotingResult::where('political_party_id', 14)->sum('count');
        return [
            "success" => true,
            "payload" => [
                "APCTotal" => number_format( $apcvotes ),
                "PDPTotal" => number_format( $pdpvotes ),
                "diff" => [
                    "difference" => $apcvotes - $pdpvotes,
                    "apc_perc" => $apcvotes / ($apcvotes+$pdpvotes),
                    "pdp_perc" => $pdpvotes / ($apcvotes+$pdpvotes)
                ],
                "progress" => [
                    "percentage" => round(($reported_pus/PollingUnit::count()) * 100,2)
                ],
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


        $party_votes = [];
        foreach($LGA->Wards as $Ward) {
            $VR = VotingResult::selectRaw("political_party_id,SUM(count) as tally")
                ->where("ward_id", $Ward->id)
                ->having("tally",">",0)
                ->groupBy("political_party_id")
                ->get();

            $all_votes = 0;

            if($VR->count() > 0){
                foreach ($VR as $vr) {
                    $party = getPoliticalParty($vr->political_party_id);
                    if(!isset($party_votes[$party->slug])){
                        $party_votes[$party->slug] = 0;
                    }


                    $r[$Ward->id]["reported"] = $Ward->reported_percentage;
                    $r[$Ward->id]["results"][$party->slug] =[
                        "ward_name" => $Ward->name,
                        "party_name" => getPoliticalParty($vr->political_party_id)->name,
                        "party_slug" => getPoliticalParty($vr->political_party_id)->slug,
                        "party_logo" => getPoliticalParty($vr->political_party_id)->logo,
                        "tally" => $vr->tally
                    ];
                    $all_votes += $vr->tally;
                    $party_votes[$party->slug] += $vr->tally;
                }
                $r[$Ward->id]['total_votes'] = $all_votes;

            }

        }

        return response()->json([
            "success" => true,
            "payload" => [
                "parties" => array_unique($Parties),
                "results" => $r,
                "party_votes" => $party_votes
            ]
        ]);
    }


    public function ajx_get_lga_pu_results_tally($ward_id){
        $r = [];
        $Ward = Ward::findOrFail($ward_id);

        $Parties = PoliticalParty::whereIn(
            "id", VotingResult::where("ward_id", $ward_id)->where('count','>',0)->pluck("political_party_id")->toArray()
        )->pluck("slug")->toArray();

        $party_votes = [];

        foreach($Ward->PollingUnits as $PU) {
            $VR = VotingResult::selectRaw("political_party_id,SUM(count) as tally")
                ->where("polling_unit_id", $PU->id)
                ->having("tally",">",0)
                ->groupBy("political_party_id")
                ->get();

            $all_votes = 0;

            if($VR->count() > 0){
                foreach ($VR as $vr) {
                    $party = getPoliticalParty($vr->political_party_id);

                    $r[$PU->id]["reported"] = $PU->reported_percentage;
                    $r[$PU->id]["results"][$party->slug] =[
                        "pu_name" => $PU->name,
                        "party_name" => getPoliticalParty($vr->political_party_id)->name,
                        "party_slug" => getPoliticalParty($vr->political_party_id)->slug,
                        "party_logo" => getPoliticalParty($vr->political_party_id)->logo,
                        "tally" => $vr->tally
                    ];
                    $all_votes += $vr->tally;
                }
                $r[$PU->id]['total_votes'] = $all_votes;

            }

        }

        return response()->json([
            "success" => true,
            "payload" => [
                "ward" => new WardResource( $Ward ),
                "pu_results" => $r,
                "pu_list" => PollingUnitResource::collection($Ward->PollingUnits),
                "party_votes" => $party_votes
            ]
        ]);
    }
}
