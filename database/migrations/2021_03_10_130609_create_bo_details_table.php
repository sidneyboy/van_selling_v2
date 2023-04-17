<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bo_details', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('bo_id')->unsigned()->index();
            $table->foreign('bo_id')->references('id')->on('bos');
            $table->BigInteger('sku_id')->unsigned()->index();
            $table->foreign('sku_id')->references('id')->on('sku_inventories');
            $table->Integer('quantity');
            $table->decimal('price',15,4);
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
        Schema::dropIfExists('bo_details');
    }
}
