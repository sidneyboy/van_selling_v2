<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingCancellationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_cancellation_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('vs_cancelation_id')->unsigned()->index();
            $table->foreign('vs_cancelation_id')->references('id')->on('van_selling_cancellations');
            $table->string('sku_code');
            $table->string('description');
            $table->string('principal');
            $table->Integer('quantity');
            $table->double('unit_price');
            $table->string('unit_of_measurement');
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
        Schema::dropIfExists('van_selling_cancellation_details');
    }
}
