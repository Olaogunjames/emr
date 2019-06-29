<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SurgeryHistory;
use App\Diagnose;

class SurgeryController extends Controller
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
        return SurgeryHistory::with('patient')->get();
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
            'operations' => 'required',
            'date_of_operation' => 'required',
            'surgeon' => 'required',           
        ]);        
        $surgery = new SurgeryHistory;
        $surgery->patient_id = $request->patient_id;       
        $surgery->operations = $request->operations;
        $surgery->date_of_operation = $request->date_of_operation;
        $surgery->surgeon = $request->surgeon;
        $surgery->modal_id = strtolower(str_random(8));

        $surgery->save();
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
        $surgery = SurgeryHistory::findOrFail($id);

        $this->validate($request, [
            'patient_id' => 'required',
            'operations' => 'required',
            'date_of_operation' => 'required',
            'surgeon' => 'required',           
        ]);        
        $surgery->update($request->all());
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
        $surgery = SurgeryHistory::findOrFail($id);
      
        $surgery->delete();  
    }
}
