<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegisterPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RegisterPatients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document_type', 5);
            $table->string('document', 15)->unique();
            $table->string('names', 150);
            $table->string('gender', 2);
            $table->string('ethnicity', 50);
            $table->string('mother_tongue', 80);
            $table->date('birth_date');
            $table->integer('age');
            $table->string('younger', 3);
            $table->string('clinic_history', 30);
            $table->date('pn_registration_date');
            $table->string('case_type', 10)->nullable();
            $table->string('cellphone', 9)->nullable();
            $table->string('pseudonym_code', 20)->nullable();
            $table->string('sure_type', 20);
            $table->string('category', 10);
            $table->string('region_register', 100);
            $table->string('province_register', 200);
            $table->string('district_register', 200);
            $table->string('establishment_register', 200);
            $table->string('region_before', 100);
            $table->string('province_before', 200);
            $table->string('district_before', 200);
            $table->string('direction_before', 400)->nullable();
            $table->string('region_current', 100);
            $table->string('province_current', 200);
            $table->string('district_current', 200);
            $table->string('direction_current', 400);
            $table->string('document_type_authorized', 5)->nullable();
            $table->string('document_authorized', 15)->nullable();
            $table->string('names_authorized', 150)->nullable();
            $table->string('cellphone_authorized', 9)->nullable();
            $table->string('intoxication_type', 150)->nullable();
            $table->string('covid_vaccination', 150)->nullable();
            $table->string('state', 3);
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
        Schema::dropIfExists('RegisterPatients');
    }
}
