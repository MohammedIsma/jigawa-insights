<?php

namespace App\Http\Controllers;

use App\Http\Resources\LGAResource;
use App\Models\LGA;
use App\Models\State;
use Illuminate\Http\Request;

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
        $lgas = array('lgas'=> $lga, 'state'=> $state);
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
