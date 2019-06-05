<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LabResult;

class LabResultController extends Controller
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
        return LabResult::with('patient', 'diagnose')->get();
        
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
            'diagnose_id' => 'required',
            'type' => 'required',
            'comment' => 'required',                    
        ]);        
        $lapresult = new LabResult;
        $lapresult->patient_id = $request->patient_id;       
        $lapresult->diagnose_id = $request->diagnose_id;
        $lapresult->type = $request->type;
        $lapresult->comment = $request->comment;
        // $diagnose->modal_id = strtolower(str_random(8));

        $lapresult->save();   
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
        $labresult = LabResult::findOrFail($id);

        $this->validate($request, [            
            'type' => 'required',
            'comment' => 'required',                    
        ]);          
        $labresult->update($request->all());
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

    public function loguser()
    {
        //
        return Auth::user();
        // return LabResult::with('patient', 'diagnose')->get();
        
    }

}
