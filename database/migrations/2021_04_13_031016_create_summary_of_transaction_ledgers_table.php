<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummaryOfTransactionLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('summary_of_transaction_ledgers', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('customer_id')->unsigned()->index();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('so_number');
            $table->decimal('so_amount',15,4);
            $table->string('dr');
            $table->Integer('ref_id');
            $table->string('check_no');
            $table->date('check_date');
            $table->decimal('collection',15,4);
            $table->decimal('bo',15,4);
            $table->string('image');
            $table->string('remarks');
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
        Schema::dropIfExists('summary_of_transaction_ledgers');
    }
}
