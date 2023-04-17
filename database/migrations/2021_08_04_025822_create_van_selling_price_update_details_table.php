<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingPriceUpdateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_price_update_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('vs_price_update_id')->unsigned()->index();
            $table->foreign('vs_price_update_id')->references('id')->on('van_selling_price_updates');
            $table->string('sku_code');
             $table->string('description');
            $table->double('updated_price',15,4);
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
        Schema::dropIfExists('van_selling_price_update_details');
    }
}
