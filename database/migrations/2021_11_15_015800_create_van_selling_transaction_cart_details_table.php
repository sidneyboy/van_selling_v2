<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingTransactionCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_transaction_cart_details', function (Blueprint $table) {
            $table->id();
            $table->string('sku_code');
            $table->string('description');
            $table->Integer('quantity');
            $table->string('principal');
            $table->string('unit_of_measurement');
            $table->string('sku_type');
            $table->string('butal_equivalent');
            $table->string('beg');
            $table->decimal('price',15,4);
            $table->Integer('user_id');
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
        Schema::dropIfExists('van_selling_transaction_cart_details');
    }
}
