<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_customers', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('location_id')->unsigned()->index();
            $table->foreign('location_id')->references('id')->on('locations');
            $table->string('store_name');
            $table->string('store_type');
            $table->string('barangay');
            $table->string('address');
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
        Schema::dropIfExists('van_selling_customers');
    }
}
