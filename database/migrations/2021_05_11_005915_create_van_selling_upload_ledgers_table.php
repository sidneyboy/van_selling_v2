<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingUploadLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_upload_ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('store_name');
            $table->string('principal');
            $table->string('sku_code');
            $table->string('description');
            $table->string('unit_of_measurement');
            $table->string('sku_type');
            $table->Integer('butal_equivalent');
            $table->string('reference');
            $table->Integer('beg');
            $table->Integer('van_load');
            $table->Integer('sales');
            $table->Integer('adjustments');
            $table->Integer('end');
            $table->double('unit_price',15,4);
            $table->string('status')->nullable();
            $table->string('status_cancel')->nullable();
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
        Schema::dropIfExists('van_selling_upload_ledgers');
    }
}
