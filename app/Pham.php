<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Pham extends Model
{
    //
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'patient_id', 'diagnose_id', 'type', 'comment', 'unit', 'nurse', 'injection'
    ];

   public function patient(){
       return $this->belongsTo('App\addPatient');
   }

   public function diagnose(){
    return $this->belongsTo('App\Diagnose');
        
    }
}
