<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->bigIncrements('order_id');
            $table->string('name')->nullable();
            $table->string('quantity')->nullable();
            $table->string('barcode')->nullable();
            $table->string('description')->nullable();
            $table->string('carton_qty')->nullable();
            $table->string('case_qty')->nullable();
            $table->string('kit_qty'->nullable());
            $table->string('unit_qty')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
