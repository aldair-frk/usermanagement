<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AclMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AclMenu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_menu', 30);
            $table->string('icono', 50);
            $table->string('order', 3);
            $table->string('state', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('AclMenu');
    }
}
