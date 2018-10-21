<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationToTrainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trains', function (Blueprint $table) {
            $table->string('address_name')->nullable()->after('address')->coment('详细住址');
            $table->string('latitude')->nullable()->after('address_name')->comment('纬度');
            $table->string('longitude')->nullable()->after('latitude')->comment('经度');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trains', function (Blueprint $table) {
            $table->dropColumn('address_name');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
