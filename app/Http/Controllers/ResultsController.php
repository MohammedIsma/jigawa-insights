<?php

namespace App\Http\Controllers;

use App\Http\Resources\IncidentResource;
use App\Models\Incident;
use App\Models\VotingResult;
use App\Models\PollingUnit;
use App\Models\AccreditationResult;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function ajx_get_tally_results(Request $request){

        $VRes = VotingResult::selectRaw("political_party_id, SUM(count) as count")
            ->groupBy("political_party_id")
            ->orderBy("count","desc")
            ->get();
        $VRes->transform(function($r){
            $P = getPoliticalParty($r->political_party_id);
            return [
                "party" => $P->name,
                "logo" => $P->logo,
                "count" => number_format($r->count)
            ];
        });


        $global_report_perc = number_format((AccreditationResult::count()/PollingUnit::count()) * 100,1);
        return response()->json([
            "time" => date("dM H:i:s"),
            "total_votes" => number_format(VotingResult::sum('count')),
            "vote_global_reporting" => $global_report_perc,
            "results" => $VRes
        ]);
    }

    public function ajx_incidences(Request $request){
        $Inc = Incident::orderBy("created_at", "desc")->get();
        return response()->json([
            "incidences" => IncidentResource::collection($Inc),
            "datetime" => date("d-M h:ia")
        ]);
    }
}
