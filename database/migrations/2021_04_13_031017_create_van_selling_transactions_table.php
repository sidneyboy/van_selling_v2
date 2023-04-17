<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_receipt');
            $table->string('store_name');
            $table->string('store_type');
            $table->string('full_address');
            $table->decimal('total_amount');
            $table->string('status');
            $table->string('pcm_number');
            $table->double('bo_amount',15,4);
            $table->date('date')->index();
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
        Schema::dropIfExists('van_selling_transactions');
    }
}
