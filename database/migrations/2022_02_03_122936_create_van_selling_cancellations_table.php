<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanSellingCancellationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('van_selling_cancellations', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('van_selling_trans_id')->unsigned()->index();
            $table->foreign('van_selling_trans_id')->references('id')->on('van_selling_transactions');
            $table->string('remarks');
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
        Schema::dropIfExists('van_selling_cancellations');
    }
}
