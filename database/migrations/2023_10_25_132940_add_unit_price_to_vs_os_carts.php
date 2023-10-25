<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitPriceToVsOsCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Vs_os_carts', function (Blueprint $table) {
            $table->double('unit_price',15,4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Vs_os_carts', function (Blueprint $table) {
            $table->dropColumn('unit_price');
        });
    }
}
