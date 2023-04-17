<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('sales_order_id')->unsigned()->index();
            $table->foreign('sales_order_id')->references('id')->on('sales_orders');
            $table->BigInteger('sku_id')->unsigned()->index();
            $table->foreign('sku_id')->references('id')->on('sku_inventories');
             $table->BigInteger('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->Integer('quantity');
            $table->string('remarks');
            $table->date('date');
            $table->string('sku_type');
            $table->string('unit_of_measurement');
            $table->decimal('price',15,4);
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
        Schema::dropIfExists('sales_order_details');
    }
}
