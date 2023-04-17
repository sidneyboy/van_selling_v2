<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerIdToOsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Van_selling_os_datas', function (Blueprint $table) {
            $table->Integer('vs_customer_id')->nullable();
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
            $table->dropColumn('vs_customer_id')->nullable();
        });
    }
}
