<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingTransactionCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_transaction_cms', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('van_selling_trans_id')->unsigned()->index();
            $table->foreign('van_selling_trans_id')->references('id')->on('van_selling_transactions');
            $table->BigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date');
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
        Schema::dropIfExists('van_selling_transaction_cms');
    }
}
