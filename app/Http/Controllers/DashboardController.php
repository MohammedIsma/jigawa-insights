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

    public function exec_dash(){
        return view("exec_dashboard");
    }
}
