<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesRegisterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_register_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('sales_register_id')->unsigned()->index();
            $table->foreign('sales_register_id')->references('id')->on('sales_register_uploadeds');
            $table->BigInteger('sku_id')->unsigned()->index();
            $table->foreign('sku_id')->references('id')->on('sku_inventories');
            $table->Integer('quantity');
            $table->decimal('price',15,4);
            $table->string('sku_type');
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
        Schema::dropIfExists('sales_register_details');
    }
}
