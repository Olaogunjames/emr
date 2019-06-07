<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HospitalHistory;
use App\Diagnose;

class DiagnoseController extends Controller
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
        return Diagnose::with('patient', 'hospital')->get();
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
            'hospital_id' => 'required',
            'diagnosis' => 'required',
            'comment' => 'required',                    
        ]);        
        $diagnose = new Diagnose;
        $diagnose->patient_id = $request->patient_id;       
        $diagnose->hospital_id = $request->hospital_id;
        $diagnose->diagnosis = $request->diagnosis;
        $diagnose->comment = $request->comment;
        $diagnose->modal_id = strtolower(str_random(8));

        $diagnose->save();       
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
        $diagnose = Diagnose::findOrFail($id);

        $this->validate($request, [            
            'diagnosis' => 'required',
            'comment' => 'required',                    
        ]);          
        $diagnose->update($request->all());
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
        $diagnose = Diagnose::findOrFail($id);

        LabResult::where('patient_id',$id)->delete();        
      
        $diagnose->delete();
    }

    
    public function labtest()
    {
        //
        return Diagnose::where('refer_lab', 1)->with('patient', 'hospital')->get();
    }

    public function phamtest()
    {
        //
        return Diagnose::where('refer_pham', 1)->with('patient', 'hospital')->get();
    
    }
}
