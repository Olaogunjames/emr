<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\addPatient;

class PatientController extends Controller
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
        return addPatient::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'full_name' => ['required', 'string', 'max:191'],
    //         'email' => ['required', 'string', 'email', 'max:191', ' unique:add_patients'],
    //         'unique_id' => ['required', ' unique:add_patients'],
    //         'phone_number' => ['required'],
    //         'title' => ['required'],
    //         'occupation' => ['required'],
    //         'sex' => ['required'],
    //         'dob' => ['required'],
    //         'religion' => ['required'],
    //         'nationality' => ['required'],
    //         'home_address' => ['required'],
    //         'place_of_birth' => ['required'],
    //         'marital_status' => ['required'],
    //         'home_next_of_kin' => ['required'],
    //         'phone_next_of_kin' => ['required'],
    //     ]);
    // }

    
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'unique_id' => 'required | unique:add_patients',
            'full_name' => 'required | string | max:191',
            'email' => 'required | string | email | max:191 | unique:add_patients',
            'title' => 'required',
            'phone_number' => 'required',
            'occupation' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'religion' => 'required',
            'nationality' => 'required',
            'home_address' => 'required',
            'place_of_birth' => 'required',
            'marital_status' => 'required',
            'home_next_of_kin' => 'required',
            'phone_next_of_kin' => 'required',
        ]);
                   
        return addPatient::create($request->all());
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
        $patient = addPatient::findOrFail($id);

        $this->validate($request, [
            'unique_id' => 'required | unique:add_patients,unique_id,'.$patient->id,
            'full_name' => 'required | string | max:191',
            'email' => 'required | string | email | max:191 | unique:add_patients,email,'.$patient->id,
            'title' => 'required',
            'phone_number' => 'required',
            'occupation' => 'required',
            'sex' => 'required',
            'dob' => 'required',
            'religion' => 'required',
            'nationality' => 'required',
            'home_address' => 'required',
            'place_of_birth' => 'required',
            'marital_status' => 'required',
            'home_next_of_kin' => 'required',
            'phone_next_of_kin' => 'required',
        ]);
        
        $patient->update($request->all());
        
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
