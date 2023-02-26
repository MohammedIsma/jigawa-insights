<?php

namespace App\Http\Controllers;

use App\Models\VotingResult;
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
        return response()->json([
            "time" => date("dM H:i:s"),
            "results" => $VRes
        ]);
    }
}
