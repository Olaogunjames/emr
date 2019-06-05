<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class SurgeryHistory extends Model
{
    //
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'patient_id', 'operations', 'date_of_operation', 'surgeon', 'modal_id'
    ];

   public function patient(){
       return $this->belongsTo('App\addPatient');
   }
}   
