<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingUploadTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_upload_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code');
            $table->string('description');
            $table->string('sku_type');
            $table->string('unit_of_measurement');
            $table->Integer('quantity');
            $table->decimal('unit_price_left',15,4);
            $table->decimal('total_left',15,4);
            $table->Integer('butal_equivalent');
            $table->Integer('quantity_butal');
            $table->decimal('unit_price_right',15,4);
            $table->decimal('total_right',15,4);
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
        Schema::dropIfExists('van_selling_upload_transactions');
    }
}
