<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class HospitalHistory extends Model
{
    //
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'patient_id', 'date_attented', 'date_admitted', 'refered_by', 'physician',  'ward', 'date_discharged', 'discharged_to', 'outcome_of_care', 'symptoms', 'comment_box', 'modal_id'
    ];

   public function patient(){
       return $this->belongsTo('App\addPatient');
   }

   public function diagnose(){
        return $this->hasOne('App\Diagnose');
    }

    
}
