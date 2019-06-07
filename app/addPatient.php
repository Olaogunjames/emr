<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class addPatient extends Model
{
    //
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'unique_id', 'title', 'full_name', 'email', 'phone_number',  'occupation', 'sex', 'dob', 'role', 'religion',  'nationality', 'state_of_origin', 'home_address', 'place_of_birth', 'marital_status', 'home_next_of_kin', 'phone_next_of_kin',
    ];

    public function vitals(){
        return $this->hasOne('App\Vital');
    }
    public function hospitals(){
        return $this->hasMany('App\HospitalHistory');
    }

    public function surgeries(){
        return $this->hasMany('App\SurgeryHistory');
    }

    public function diagnose(){
        return $this->hasMany('App\Diagnose');
    }

    public function payment(){
        return $this->hasMany('App\Payment');
    }

    public function appointment(){
        return $this->hasMany('App\Appointment');
    }
}