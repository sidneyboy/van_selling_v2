<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ar_ledgers', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->BigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('date_delivered');
             $table->string('export_code');
            $table->string('delivery_receipt');
            $table->double('amount',15,4);
            $table->double('collected',15,4);
            $table->double('balance',15,4);
            $table->string('check_details');
            $table->double('total_cm',15,4);
            $table->double('final_balance',15,4);
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
        Schema::dropIfExists('ar_ledgers');
    }
}
