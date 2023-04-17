<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVsUploadInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vs_upload_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('principal');
            $table->string('sku_code');
            $table->string('description');
            $table->string('unit_of_measurement');
            $table->string('sku_type');
            $table->string('butal_equivalent');
            $table->string('reference');
            $table->integer('quantity');
            $table->integer('running_balance');
            $table->double('unit_price');
            $table->string('status')->nullable();
            $table->string('status_cancel')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('vs_upload_inventories');
    }
}
