<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('UserId');
            $table->unsignedInteger('open_id')->nullable()->comment('OpenId');
            $table->unsignedInteger('to_user_id')->nullable()->comment('toUserId');
            $table->unsignedInteger('type_id')->nullable()->comment('付款类别ID');

            $table->string('customer')->nullable()->comment('客户名称');
            $table->string('goods_name')->nullable()->comment('品名');
            $table->string('number_id')->nullable()->comment('单号');
            $table->string('quantity')->nullable()->comment('数量');
            $table->decimal('total_fee')->nullable()->comment('总费用');

            $table->string('timeStamp')->nullable()->comment('');
            $table->string('package')->nullable()->comment('');
            $table->string('nonceStr')->nullable()->comment('');
            $table->string('signType')->nullable()->comment('');
            $table->string('paySign')->nullable()->comment('');

            $table->text('remark')->nullable()->comment('备注');

            $table->timestamp('times_at')->nullable()->comment('付款时间');
            $table->timestamp('times_end')->nullable()->comment('成交时间');
            $table->string('close_comment')->default('F')->comment('关闭评论');
            $table->string('is_hidden')->default('F')->comment('隐藏');

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
        Schema::dropIfExists('payments');
    }
}
