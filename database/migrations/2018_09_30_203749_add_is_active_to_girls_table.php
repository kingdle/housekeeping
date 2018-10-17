<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActiveToGirlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('girls', function (Blueprint $table) {
            $table->integer('is_active')->default(0)->after('is_hidden')->comment('是否审核0待审1已审核');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('girls', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
