<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Diagnose extends Model
{
    //
    use Notifiable, HasApiTokens;

     protected $fillable = [
        'patient_id', 'hospital_id', 'diagnosis', 'comment', 'refer_lab',  'refer_pham', 'modal_id'
    ];

   public function patient(){
       return $this->belongsTo('App\addPatient');
   }

   public function hospital(){
    return $this->belongsTo('App\HospitalHistory');
        
    }

    public function labresult(){
        return $this->hasOne('App\LabResult');
    }

}
