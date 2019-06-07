<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::apiResources([
        'patient' => 'API\PatientController',
        'vital' => 'API\VitalController',
        'hospital' => 'API\HospitalController',
        'surgery' => 'API\SurgeryController',
        'diagnose' => 'API\DiagnoseController',
        'uploadtest' => 'API\LabResultController',
        'uploadpham' => 'API\phamController',
        'payment' => 'API\PaymentController',
        'staff' => 'API\StaffController',
        'appointment' => 'API\AppointmentController',
    ]);
    
    Route::get('labtest', 'API\DiagnoseController@labtest');
    Route::get('phamtest', 'API\DiagnoseController@phamtest');
    Route::get('give-injection', 'API\phamController@giveInjection');
    Route::post('paymentsave', 'API\PaymentController@paymentsave');
    Route::get('profile', 'API\StaffController@profile');



