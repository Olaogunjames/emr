<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pham;

class phamController extends Controller
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
        return Pham::with('patient', 'diagnose')->get();
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
            'unit' => 'required',
        ]);        
        $pham = new Pham;
        $pham->patient_id = $request->patient_id;       
        $pham->diagnose_id = $request->diagnose_id;
        $pham->type = $request->type;
        $pham->comment = $request->comment;
        $pham->nurse = $request->nurse;
        $pham->unit = $request->unit;
        // $diagnose->modal_id = strtolower(str_random(8));

        $pham->save(); 

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
        $pham = Pham::findOrFail($id);

        $this->validate($request, [            
            'type' => 'required',
            'comment' => 'required', 
            'unit' => 'required'
        ]);          
        $pham->update($request->all());
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

    public function giveInjection()
    {
        //
        return Pham::where('nurse', 1)->with('patient', 'diagnose')->get();
    
    }
}
