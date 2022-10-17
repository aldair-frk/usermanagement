<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('Users', function (Blueprint $table) {
            // $table->bigIncrements('id');
            // $table->string('password', 100);
            // $table->timestamp('last_login');
            // $table->string('username', 100);
            // $table->boolean('is_super', 5);
            // $table->boolean('is_admin', 5);
            // $table->boolean('is_active', 2);
            // $table->string('province_name', 100) ->nullable();
            // $table->string('district_name', 100) ->nullable();
            // $table->unsignedBigInteger('person_id');
            // $table->foreign('person_id')->references('id')->on('Person');
            // $table->rememberToken();
            // $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('Users');
    }
}
