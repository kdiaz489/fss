<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KitTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kit_tbl', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigIncrements('user_id');
            $table->string('kit_name');
            $table->float('kit_price');
            $table->string('kit_sku');
            $table->string('kit_desc');
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
        Schema::drop('kit_tbl');
    }
}
