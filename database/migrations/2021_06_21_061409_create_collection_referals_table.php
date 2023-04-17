<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionReferalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_referals', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('collection_id')->unsigned()->index();
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->string('refer_agent');
            $table->string('refer_delivery_receipt');
            $table->string('refer_principal');
            $table->double('refer_cash',15,4);
            $table->double('refer_check',15,4);
            $table->string('refer_remarks');
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
        Schema::dropIfExists('collection_referals');
    }
}
