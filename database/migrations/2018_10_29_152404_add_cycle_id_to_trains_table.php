<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCycleIdToTrainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trains', function (Blueprint $table) {
            $table->unsignedInteger('cycle_id')->after('product_id')->nullable()->comment('培训批次ID');
            $table->timestamp('cycle_at')->after('cycle_id')->nullable()->comment('培训时间');
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
            $table->dropColumn('cycle_id');
            $table->dropColumn('cycle_at');
        });
    }
}
