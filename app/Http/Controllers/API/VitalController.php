<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\addPatient;
use App\Vital;
class VitalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //        
        return Vital::with('patient')->get();
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
        $this->validate($request, [
            'patient_id' => 'required',
            'temperature' => 'required',
            'blood_pressure' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'pulse' => 'required',
            'blood_group' => 'required',
            'blood_type' => 'required',
            'immunization' => 'required',            
        ]);
        $vital = new Vital;
        $vital->patient_id = $request->patient_id;       
        $vital->temperature = $request->temperature;
        $vital->blood_pressure = $request->blood_pressure;
        $vital->height = $request->height;
        $vital->weight = $request->weight;
        $vital->pulse = $request->pulse;
        $vital->blood_group = $request->blood_group;
        $vital->blood_type = $request->blood_type;
        $vital->immunization = $request->immunization;

        $vital->save();
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
        $vital = Vital::findOrFail($id);

        $this->validate($request, [
            'patient_id' => 'required',
            'temperature' => 'required',
            'blood_pressure' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'pulse' => 'required',
            'blood_group' => 'required',
            'blood_type' => 'required',
            'immunization' => 'required',            
        ]);        
        $vital->update($request->all());
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
        $vital = Vital::findOrFail($id);
      
        $vital->delete();   
    }
}
