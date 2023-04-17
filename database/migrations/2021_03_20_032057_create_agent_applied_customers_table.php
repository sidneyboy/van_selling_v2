<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentAppliedCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_applied_customers', function (Blueprint $table) {
            $table->id();
            // $table->BigInteger('user_id')->unsigned()->index();
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->BigInteger('customer_id')->unsigned()->index();
            // $table->foreign('customer_id')->references('id')->on('customers');
            // $table->BigInteger('location_id')->unsigned()->index();
            // $table->foreign('location_id')->references('id')->on('locations');
            $table->Integer('user_id');
            $table->Integer('customer_id');
            $table->Integer('location_id');
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
        Schema::dropIfExists('agent_applied_customers');
    }
}
