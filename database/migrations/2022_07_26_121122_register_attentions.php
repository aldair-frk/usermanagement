<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegisterAttentions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RegisterAttentions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document', 15);
            $table->string('year_a', 4);
            $table->string('month_a', 2);
            $table->string('solicitude_medic', 3)->nullable();
            $table->string('reference', 3)->nullable();
            $table->string('reference_place', 200)->nullable();
            $table->string('against_reference', 3)->nullable();
            $table->string('against_reference_place', 200)->nullable();
            $table->string('integral_attention', 4)->nullable();
            $table->string('link_attention', 200)->nullable();
            $table->string('specialized_attention', 3)->nullable();
            $table->string('specialized_attention_detail', 200)->nullable();
            $table->string('medicine_attention', 200)->nullable();
            $table->string('nursing_attention', 200)->nullable();
            $table->string('obstetrics_attention', 200)->nullable();
            $table->string('psychology_attention', 200)->nullable();
            $table->string('odontology_attention', 200)->nullable();
            $table->string('cred_attention', 200)->nullable();
            $table->string('telemedicine_attention', 200)->nullable();
            $table->string('vaccine_attention', 200)->nullable();
            $table->string('pb_attention', 200)->nullable();
            $table->string('as_attention', 200)->nullable();
            $table->string('cd_attention', 200)->nullable();
            $table->string('hg_attention', 200)->nullable();
            $table->string('other_attention', 200)->nullable();
            $table->string('hemoglobin', 200)->nullable();
            $table->string('urine', 200)->nullable();
            $table->string('liver_profile', 200)->nullable();
            $table->string('hematocrit', 200)->nullable();
            $table->string('lipidic_profile', 200)->nullable();
            $table->string('telemedicine', 5)->nullable();
            $table->string('type_intervention', 200)->nullable();
            $table->string('ipress_attention', 200)->nullable();
            $table->string('service_attention', 200)->nullable();
            $table->string('date_attention', 200)->nullable();
            $table->string('results_attention', 200)->nullable();
            $table->string('observations_attention', 200)->nullable();
            $table->string('patient_id', 15)->nullable();
            $table->string('period', 8)->nullable();
            $table->timestamps();
            // $table->foreign('patient_id')->references('id')->on('RegisterPatients');
            // $table->foreign('document')->references('document')->on('RegisterPatients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RegisterAttentions');
    }
}
