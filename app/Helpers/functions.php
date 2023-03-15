<?php

use App\Models\LGA;
use App\Models\PoliticalParty;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\VotingResult;
use Illuminate\Support\Facades\Cache;

function getAccClass($cl){
    if($cl<25){
        return "danger";
    }elseif($cl<50){
        return "warning";
    }elseif($cl<75){
        return "info";
    }else{
        return "success";
    }
}

function getTurnClass($cl, $whitetxt=true){
    $twhite = $whitetxt ? "text-white" : "";

    if($cl<50){
        return "danger";
    }elseif($cl<75){
        return "info";
    }else{
        return "success $twhite";
    }
}


function canUpdatePollingUnit(PollingUnit $pu){
    return in_array($pu->ward_id, auth()->user()->allowed_wards);
}

function getVoteCount(PollingUnit $pu, PoliticalParty $p=null){
    $Result = VotingResult::where("polling_unit_id", $pu->id);
    if($p){
        $Result = $Result->where("political_party_id", $p->id);
    }

    return $Result->sum("count");
}

function getPoliticalParty($pid){
    return Cache::remember("get_pparty$pid", 3600, function() use($pid){
        return PoliticalParty::find($pid);
    });
}

function getState($sid){
    return Cache::remember("get_sstate$sid", 3600, function() use($sid){
        return State::find($sid);
    });
}

function getLGA($sid){
    return Cache::remember("get_slga$sid", 3600, function() use($sid){
        return LGA::find($sid);
    });
}

function VoteResults(PollingUnit $pu, PoliticalParty $p=null){
    $Result = VotingResult::where("polling_unit_id", $pu->id);
    if($p){
        $Result = $Result->where("political_party_id", $p->id);
    }

    return $Result->orderBy("count", "desc")->get();
}
