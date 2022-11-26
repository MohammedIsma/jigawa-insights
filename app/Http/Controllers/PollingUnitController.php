<?php

namespace App\Http\Controllers;

use App\Models\LGA;
use App\Models\PollingUnit;
use App\Models\State;
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
        $units = PollingUnit::findOrFail($id);
        if($units){
            //return response()->json(['data'=> $unit]);
            return view('unit', compact('units'));
        }else{
            return response()->json(['message'=> 'unit not found'], 404);
        }
    }

    public function showPollingUnitByLGI($id)
    {
        //
        $unit = PollingUnit::where('l_g_a_id',$id)->get();
        if($unit){
            $ward = LGA::find($id); 
            $units = array('units'=> $unit, 'ward'=> $ward->local_name);
            //return response()->json(['units'=> $unit]);
            return view('unit', compact('units'));
        }else{
            return response()->json(['message'=> 'unit not found'], 404);
        }
    }

    public function showPollingUnitByState($id)
    {
        //
        $unit = PollingUnit::where('state_id',$id)->get();
        if($unit){
            $state = State::find($id); 
            $units = array('units'=> $unit, 'state'=> $state->state_name);
            //return response()->json(['units'=> $unit]);
            return view('unit', compact('units'));
        }else{
            return response()->json(['message'=> 'unit not found'], 404);
        }
    }

    public function showPollingUnitByWard($id)
    {
        //
        $unit = PollingUnit::where('ward_id',$id)->get();
        if($unit){
            $ward = Ward::find($id); 
            $units = array('units'=> $unit, 'ward'=> $ward->local_name);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
