<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficialRequest;
use App\Models\LGA;
use App\Models\Official;
use App\Models\OfficialType;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\Ward;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $officials = Official::all();
        if($officials){
        return view('officials', compact('officials',));
        }else{
            return response()->json(['message'=> 'Record not found'], 404);
        }

    }

    public function officialsByState($id)
    {
        //
        $officials = Official::where('state_id', $id)->get();
        $state = State::find($id);
        if($officials){
        return view('officials', compact('officials', 'state'));
        }else{
            return response()->json(['message'=> 'Record not found'], 404);
        }

    }

    public function officialsByLGA($id)
    {
        //
        $officials = Official::where('lga_id', $id)->get();
        $lga = LGA::find($id);
        if($officials){
        return view('officials', compact('officials', 'lga'));
        }else{
            return response()->json(['message'=> 'Record not found'], 404);
        }

    }

    public function officialsByWard($id)
    {
        //
        $officials = Official::where('ward_id', $id)->get();
        $ward = Ward::find($id);
        if($officials){
        return view('officials', compact('officials', 'ward'));
        }else{
            return response()->json(['message'=> 'Record not found'], 404);
        }

    }

    public function officialsByUnit($id)
    {
        //
        $officials = Official::where('polling_unit_id', $id)->get();
        $unit = PollingUnit::find($id);
        if($officials){
        return view('officials', compact('officials', 'unit'));
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
        return view('creatOfficial', );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficialRequest $request)
    {
        //
        // if($request->validate()){
            $officialType = OfficialType::where('slug', $request->official_type_id)->get()[0]->id;
            //return $officialType[0]->id;
        $official = Official::create([
        'name' => $request->name ,
        'phone_number' => $request->phone_number,
        'designation' => $request->designation,
        'official_type_id' => $officialType,
        'state_id' => $request->state_id,
        'lga_id' => $request->lga_id,
        'ward_id' => $request->ward_id,
        'polling_unit_id' => $request->pollingUnit_id,
            ]);
        if ($official){
            $officials = Official::all();
        return view('officials', compact('officials'));
        }else{
            return response()->json(['message'=> 'Record not found'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function show(Official $official)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function edit(Official $official)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Official $official)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function destroy(Official $official)
    {
        //
    }
}
