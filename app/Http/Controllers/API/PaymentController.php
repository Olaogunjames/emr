<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Payment::with('patient')->get();
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
        setcookie('patient_id' , $request->patient_id , time()+3600 );
        setcookie('type' , $request->type , time()+3600 );
        setcookie('amount' , $request->amount , time()+3600 );
        setcookie('email' , $request->email , time()+3600 );

        return $request->all();
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

    public function paymentsave(Request $request)
    {
        //
        $pay = new Payment;
        $pay->patient_id = $_COOKIE['patient_id'];
        $pay->type = $_COOKIE['type'];
        $pay->amount = $_COOKIE['amount'];
        $pay->email = $_COOKIE['email']; 
        $pay->ref = $request->ref_id;  
        
        $pay->save();
    }
}
