<?php

namespace App\Http\Controllers;

use App\Models\LGA;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\Ward;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function landing(){
        return view("dash.landing");
    }

    public function dash()
    {
        $state = State::count();
        $lga = LGA::count();
        $ward = Ward::count();
        $unit = PollingUnit::count();
        $totals = array(
            'state'=> $state,
            'lga'=> $lga,
            'ward'=> $ward,
            'unit'=> $unit
        );

        if($totals){
        //return response()->json($totals);
        return view('dash', compact('totals'));
        }else{

            return response()->json(['message'=> 'Record not found'], 404);
        }
    }

    public function accreditation_dash_1(){
        return view("dash.exec_dashboard");
    }
    public function tally_dash(){
        return view("dash.tally_dashboard");
    }
    public function scoreboard_dash(){
        return view("dash.scoreboard_dashboard");
    }
    public function problem_dash(){
        return view("dash.problem_dashboard");
    }
    public function spread_dash($lgaid=null, $wardid=null, $puid=null){
        return view("dash.spread_dashboard", compact('lgaid','wardid','puid'));
    }
}
