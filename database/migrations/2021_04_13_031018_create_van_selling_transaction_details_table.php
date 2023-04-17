<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code');
            $table->string('description');
            $table->Integer('quantity');
            $table->string('principal');
            $table->decimal('price',15,4);
            $table->decimal('amount',15,4);
            $table->BigInteger('van_selling_trans_id')->unsigned()->index();
            $table->foreign('van_selling_trans_id')->references('id')->on('van_selling_transactions');
            $table->string('status');
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
        Schema::dropIfExists('van_selling_transaction_details');
    }
}
