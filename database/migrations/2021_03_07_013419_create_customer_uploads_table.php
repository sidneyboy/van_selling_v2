<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_uploads', function (Blueprint $table) {
            $table->id();
            // $table->BigInteger('user_id')->unsigned()->index();
            // $table->foreign('user_id')->references('id')->on('users');
            $table->Integer('user_id');
            $table->string('customer_export_code');
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
        Schema::dropIfExists('customer_uploads');
    }
}
