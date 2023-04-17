<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitPriceToOsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Van_selling_os_datas', function (Blueprint $table) {
            $table->double('unit_price',15,4)->nullable();
            $table->double('served_unit_price',15,4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Van_selling_os_datas', function (Blueprint $table) {
            $table->dropColumn('unit_price',15,4)->nullable();
            $table->dropColumn('served_unit_price',15,4)->nullable();
        });
    }
}
