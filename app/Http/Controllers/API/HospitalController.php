<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HospitalHistory;
use App\Diagnose;

class HospitalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /***
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return HospitalHistory::with('patient')->get();
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
            'date_attented' => 'required',
            'date_admitted' => 'required',
            'refered_by' => 'required',
            'ward' => 'required',
            'date_discharged' => 'required',
            'discharged_to' => 'required',
            'outcome_of_care' => 'required',
            'symptoms' => 'required',            
            'physician' => 'required',  
            'comment_box' => 'required',  
        ]);        
        $hospital = new HospitalHistory;
        $hospital->patient_id = $request->patient_id;       
        $hospital->date_attented = $request->date_attented;
        $hospital->date_admitted = $request->date_admitted;
        $hospital->refered_by = $request->refered_by;
        $hospital->ward = $request->ward;
        $hospital->date_discharged = $request->date_discharged;
        $hospital->discharged_to = $request->discharged_to;
        $hospital->outcome_of_care = $request->outcome_of_care;
        $hospital->physician = $request->physician;
        $hospital->symptoms = $request->symptoms;
        $hospital->comment_box = $request->comment_box;
        $hospital->modal_id = strtolower(str_random(8));

        $hospital->save();
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
        $hospital = HospitalHistory::findOrFail($id);

        $this->validate($request, [
            'patient_id' => 'required',
            'date_attented' => 'required',
            'date_admitted' => 'required',
            'refered_by' => 'required',
            'ward' => 'required',
            'date_discharged' => 'required',
            'discharged_to' => 'required',
            'outcome_of_care' => 'required',
            'symptoms' => 'required',            
            'physician' => 'required',  
            'comment_box' => 'required',  
        ]);        
        $hospital->update($request->all());
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
        $hospital = HospitalHistory::findOrFail($id);

        Diagnose::where('hospital_id',$id)->delete();      
      
        $hospital->delete(); 
    }
}
