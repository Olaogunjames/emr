<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Payment extends Model
{
    //
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'patient_id', 'type', 'amount', 'ref', 'email'
    ];

   public function patient(){
       return $this->belongsTo('App\addPatient');
   }
}
