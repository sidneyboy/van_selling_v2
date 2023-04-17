<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('collection_id')->unsigned()->index();
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->double('total_dr_amount',15,4);
            $table->double('cash',15,4);
            $table->double('check',15,4);
            $table->double('over_payment',15,4);
            $table->string('delivery_receipt');
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
        Schema::dropIfExists('collection_details');
    }
}
