<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code');
            $table->string('description');
            $table->string('principal',100);
            $table->string('sku_type');
            $table->string('unit_of_measurement');
            $table->double('unit_price',15,4);
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
        Schema::dropIfExists('van_selling_inventories');
    }
}
