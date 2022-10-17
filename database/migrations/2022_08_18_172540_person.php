<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Person extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Person', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dni', 8)->unique();
            $table->string('last_name0', 30);
            $table->string('last_name1', 30);
            $table->string('names', 40);
            $table->date('birth_date', 10);
            $table->string('gender', 2);
            $table->string('address', 40);
            $table->string('phone', 9) ->nullable();;
            $table->string('institute', 30) ->nullable();;
            $table->boolean('is_region', 5);
            $table->boolean('is_province', 5);
            $table->boolean('is_district', 5);
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
        Schema::dropIfExists('Person');
    }
}
