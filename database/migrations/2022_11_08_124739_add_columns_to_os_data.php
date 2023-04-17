<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToOsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Van_selling_os_datas', function (Blueprint $table) {
            $table->Integer('served_quantity')->nullable();
            $table->string('served_date')->nullable();
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
            $table->dropColumn('served_quantity')->nullable();
            $table->dropColumn('served_date')->nullable();
        });
    }
}
