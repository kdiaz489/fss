<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BasicUnitKit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic__unit_kit', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kit_id')->unsigned();
            $table->integer('basic__unit_id')->unsigned();
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
        //
        Schema::drop('basic__unit_kit');
    }
}
