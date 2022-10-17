<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullFileCategoryPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('RegisterPatients', function (Blueprint $table) {
            $table->string('category', 10) ->nullable() ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('RegisterPatients', function (Blueprint $table) {
            $table->string('category', 10) ->change();
        });
    }
}
