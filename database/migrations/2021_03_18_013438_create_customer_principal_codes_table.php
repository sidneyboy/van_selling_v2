<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPrincipalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_principal_codes', function (Blueprint $table) {
            $table->id();
            // $table->BigInteger('customer_id')->unsigned()->index();
            // $table->foreign('customer_id')->references('id')->on('customers');
            // $table->BigInteger('principal_id')->unsigned()->index();
            // $table->foreign('principal_id')->references('id')->on('principals');
            $table->Integer('customer_id');
            $table->Integer('principal_id');
            $table->string('store_code');
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
        Schema::dropIfExists('customer_principal_codes');
    }
}
