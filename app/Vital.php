<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Vital extends Model
{
    //
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'patient_id', 'temperature', 'blood_pressure', 'height', 'weight',  'pulse', 'blood_group', 'blood_type', 'immunization'
    ];

   public function patient(){
       return $this->belongsTo('App\addPatient');
   }

   protected $casts = ['immunization' => 'array'];
}
