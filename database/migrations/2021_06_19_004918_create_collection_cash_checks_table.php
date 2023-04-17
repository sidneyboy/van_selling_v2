<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionCashChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_cash_checks', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('collection_id')->unsigned()->index();
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->string('particulars');
            $table->string('check_no');
            $table->string('bank');
            $table->string('check_date');
            $table->double('amount',15,4);
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
        Schema::dropIfExists('collection_cash_checks');
    }
}
