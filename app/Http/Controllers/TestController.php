<?php

namespace App\Http\Controllers;

use App\Models\LGA;
use App\Models\PollingUnit;
use App\Models\VotingResult;
use App\Models\Ward;
use App\Jobs\UpdateCounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{
    public function test(){

        UpdateCounts::dispatchSync([257,252,253,55,24]);

        exit;
        $parties = getPopularParties();
        $pids = $parties->pluck("id")->toArray();

        $lgids = [2,7,20,25,26,27,23,24,12,17,8,9];
        $Wards = Ward::whereIn("lga_id", $lgids)->get();
        $wids = Ward::whereIn("lga_id", $lgids)->pluck("id")->toArray();
        $PUs = PollingUnit::whereIn('ward_id', $wids)->get();

        $Intelligence = [];

        foreach($Wards as $ww) {
            $Intelligence[$ww->lga_id][$ww->id] = [
                'poor_turnout' => [],
                'weak_turnout_with_advantage' => [],
                'high_turnout_disadvantage' => [],
                'significant_disadvantage' => [],
                'significant_advantage' => [],
            ];
        }

        foreach($PUs as $pu){

            $k = $pu->number . "-" . date("d-") . "salT1";
            $apc_votes = Cache::remember("apc-$k", 36000, function () use ($pu){
                return VotingResult::where('polling_unit_id', $pu->id)->where('political_party_id', 7)->sum('count');
            });
            $pdp_votes = Cache::remember("pdp-$k", 36000, function () use ($pu){
                return VotingResult::where('polling_unit_id', $pu->id)->where('political_party_id', 14)->sum('count');
            });
            $other_votes = Cache::remember("other-$k", 36000, function () use ($pu){
                return VotingResult::where('polling_unit_id', $pu->id)->whereNotIn('political_party_id', [7,14])->sum('count');
            });
            $all_votes = $apc_votes+$pdp_votes+$other_votes;
            $turnout = round($all_votes/$pu->voter_count,1);

            $LGA = getLGA($pu->lga_id);
            $Ward = getWard($pu->ward_id);


            if($all_votes) {
                if ((($pdp_votes - $apc_votes) / $all_votes) > .25) {
                    $Intelligence[$LGA->id][$Ward->id]['significant_disadvantage'][] = $pu->id;
                }
                if ((($apc_votes - $pdp_votes) / $all_votes) > .25) {
                    $Intelligence[$LGA->id][$Ward->id]['significant_advantage'][] = $pu->id;
                }
            }

            if( $turnout<.3 ){
                if( ($apc_votes>$pdp_votes) && ($turnout<.4) ){
                    $Intelligence[$LGA->id][$Ward->id]['weak_turnout_with_advantage'][] = $pu->id;
                }else {
                    $Intelligence[$LGA->id][$Ward->id]['poor_turnout'][] = $pu->id;
                }
            }else{
                if( ($apc_votes<$pdp_votes) && ($turnout>.4) ) {
                    $Intelligence[$LGA->id][$Ward->id]['high_turnout_disadvantage'][] = $pu->id;
                }
            }



//            echo sprintf("%s!%s!%s!%s!%s!%s!%s!%s!%s<br />",
//                $LGA->name,
//                $Ward->name,
//                $pu->number,
//                $pu->name,
//                $pu->voter_count,
//                $apc_votes,
//                $pdp_votes,
//                $other_votes,
//                $turnout
//            );

        }

        foreach(LGA::whereIn("id", $lgids)->get() as $lga){
            echo "$lga->name <br />";
            foreach($lga->Wards as $w){
                foreach($w->PollingUnits as $pu){

                    $issues = [];
                    if(in_array($pu->id, $Intelligence[$lga->id][$w->id]['significant_advantage'])){
                        $issues[] = "APC Advantage. Valuable. Continue to focus";
                    }
                    if(in_array($pu->id, $Intelligence[$lga->id][$w->id]['poor_turnout'])){
                        $issues[] = "Low turnout. Try to mobilize voters";
                    }
                    if(in_array($pu->id, $Intelligence[$lga->id][$w->id]['weak_turnout_with_advantage'])){
                        $issues[] = "APC friendly but weak turnout. Increase voter turnout.";
                    }
                    if(in_array($pu->id, $Intelligence[$lga->id][$w->id]['high_turnout_disadvantage'])){
                        $issues[] = "PDP Advantage with high turnout. Suppress PDP efforts. Pay attention!";
                    }
                    if(in_array($pu->id, $Intelligence[$lga->id][$w->id]['significant_disadvantage'])){
                        $issues[] = "Hostile! Pay special attention.";
                    }

                    if(count($issues)==0){
                        continue;
                    }
                    echo $w->name . "|" . $pu->number . "|" . $pu->name . "|";
                    echo implode(",", $issues) . "<br />";
                }
            }
        }
    }

    public function test2(){
        $parties = getPopularParties();
        $pids = $parties->pluck("id")->toArray();

        $lgids = [8,9,17,12,24,27];
        $lgids = [23];
        $Wards = Ward::whereIn("lga_id", $lgids)->get();
        $wids = Ward::whereIn("lga_id", $lgids)->pluck("id")->toArray();
        $PUs = PollingUnit::whereIn('ward_id', $wids)->get();

        $Intelligence = [];

        foreach($Wards as $ww) {
            $Intelligence[$ww->lga_id][$ww->id] = [
                'poor_turnout' => [],
                'weak_turnout_with_advantage' => [],
                'high_turnout_disadvantage' => [],
                'significant_disadvantage' => [],
                'significant_advantage' => [],
            ];
        }

        foreach($PUs as $pu){

            $k = $pu->number . "-" . date("d-") . "salT1";
            $apc_votes = Cache::remember("apc-$k", 36000, function () use ($pu){
                return VotingResult::where('polling_unit_id', $pu->id)->where('political_party_id', 7)->sum('count');
            });
            $pdp_votes = Cache::remember("pdp-$k", 36000, function () use ($pu){
                return VotingResult::where('polling_unit_id', $pu->id)->where('political_party_id', 14)->sum('count');
            });
            $other_votes = Cache::remember("other-$k", 36000, function () use ($pu){
                return VotingResult::where('polling_unit_id', $pu->id)->whereNotIn('political_party_id', [7,14])->sum('count');
            });
            $all_votes = $apc_votes+$pdp_votes+$other_votes;
            $turnout = round($all_votes/$pu->voter_count,1);

            $LGA = getLGA($pu->lga_id);
            $Ward = getWard($pu->ward_id);

            echo sprintf("%s!%s!%s!%s!%s!%s!%s!%s!%s<br />",
                $LGA->name,
                $Ward->name,
                $pu->number,
                $pu->name,
                $pu->voter_count,
                $apc_votes,
                $pdp_votes,
                $other_votes,
                $turnout
            );

        }

    }

}
