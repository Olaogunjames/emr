<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id')->unique();
            $table->string('title');
            $table->string('full_name');            
            $table->string('email')->unique();
            $table->string('phone_number');  
            $table->string('occupation');  
            $table->string('sex');  
            $table->string('dob');  
            $table->string('religion');  
            $table->string('nationality');  
            $table->string('state_of_origin');  
            $table->string('home_address'); 
            $table->string('place_of_birth'); 
            $table->string('marital_status'); 
            $table->string('home_next_of_kin'); 
            $table->string('phone_next_of_kin'); 
            $table->timestamps();
        });
    }   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_patients');
    }
}
