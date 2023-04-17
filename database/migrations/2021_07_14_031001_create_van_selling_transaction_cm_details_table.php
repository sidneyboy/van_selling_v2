<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingTransactionCmDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_transaction_cm_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('vs_trans_cm_id')->unsigned()->index();
            $table->foreign('vs_trans_cm_id')->references('id')->on('van_selling_transaction_cms');
            $table->string('sku_code');
            $table->string('description');
            $table->Integer('dr_quantity');
            $table->Integer('rgs_quantity');
            $table->Integer('bo_quantity');
            $table->double('unit_price',15,4);
            $table->string('remarks');
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
        Schema::dropIfExists('van_selling_transaction_cm_details');
    }
}
