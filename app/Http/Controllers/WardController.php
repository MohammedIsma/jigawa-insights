<?php

namespace App\Http\Controllers;

use App\Models\LGA;
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    public function wardByLGA($id)
    {
        //
        $ward = Ward::where('l_g_a_id',$id)
        ->withCount('pollingUnit')->get();
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
}
