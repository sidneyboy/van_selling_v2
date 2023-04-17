<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVsCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vs_carts', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code')->nullable();
            $table->string('description')->nullable();
            $table->string('principal')->nullable();
            $table->string('unit_of_measurement')->nullable();
            $table->string('sku_type')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('price',15,4)->nullable();
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
        Schema::dropIfExists('vs_carts');
    }
}
