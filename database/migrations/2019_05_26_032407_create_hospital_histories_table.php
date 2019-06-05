<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_id');
            $table->string('date_attented');
            $table->string('date_admitted');            
            $table->string('ward');
            $table->string('refered_by');  
            $table->string('physician');  
            $table->string('date_discharged');  
            $table->string('discharged_to');  
            $table->string('outcome_of_care');
            $table->string('symptoms');  
            $table->string('comment_box');
            $table->string('modal_id')->unique();
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
        Schema::dropIfExists('hospital_histories');
    }
}
