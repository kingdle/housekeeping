<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('0')->after('emergency')->comment('状态');
            $table->string('status_mean')->nullable()->after('status')->comment('状态意思');
            $table->string('address_full')->nullable()->after('price')->comment('详细地址');
            $table->string('phone')->nullable()->after('address')->comment('联系电话');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('status_mean');
            $table->dropColumn('city');
            $table->dropColumn('phone');
        });
    }
}
