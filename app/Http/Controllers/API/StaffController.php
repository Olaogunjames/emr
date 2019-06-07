<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class StaffController extends Controller
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
        return User::all();
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
            'name' => 'required | string | max:191',
            'email' => 'required | string | email | max:191 | unique:users',
            'password' => 'required | string | min:8',
            'role' => 'required',
            'title' => 'required',           
        ]);

        $staff = new User;
        $staff->name = $request->name;       
        $staff->title = $request->title;
        $staff->role = $request->role;
        $staff->email = $request->email;
        $staff->password = Hash::make($request->password);

        $staff->save();
                   
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
        $staff = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required | string | max:191',
            'email' => 'required | string | email | max:191 | unique:add_patients,email,'.$staff->id,
            'role' => 'required',
            'title' => 'required', 
        ]);
        
        $staff->update($request->all());
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
        $staff = User::findOrFail($id);
      
        $staff->delete();
    }

    public function profile()
    {
        //
        return \Auth::user();
    }
}
