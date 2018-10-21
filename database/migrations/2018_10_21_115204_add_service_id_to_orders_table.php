<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServiceIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('service_id')->nullable()->after('to_user_id')->comment('服务人员ID');
            $table->timestamp('service_at')->nullable()->after('is_hidden')->comment('服务人员操作日期');
            $table->string('is_pay')->default('F')->after('status')->comment('是否缴费');
            $table->timestamp('pay_at')->nullable()->after('service_at')->comment('服务人员操作日期');
            $table->string('discount')->default('1')->after('price')->comment('折扣');
            $table->decimal('fee')->default('1.00')->after('discount')->comment('实际付款');
            $table->string('address_name')->nullable()->after('address')->coment('坐标路名');
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('service_id');
            $table->dropColumn('service_at');
            $table->dropColumn('is_pay');
            $table->dropColumn('pay_at');
            $table->dropColumn('discount');
            $table->dropColumn('fee');
            $table->dropColumn('address_name');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
