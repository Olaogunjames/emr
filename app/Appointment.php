<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    //
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'patient_id', 'reason', 'date'
    ];

   public function patient(){
       return $this->belongsTo('App\addPatient');
   }
}
