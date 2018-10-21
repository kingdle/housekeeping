<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable()->comment('发布用户ID');
            $table->string('to_user_id')->nullable()->comment('选中服务人员ID');
            $table->string('product_id')->nullable()->comment('分类ID');
            $table->decimal('price')->default('1.00')->comment('参考价');
            $table->text('address')->nullable()->comment('服务地址');
            $table->text('content')->nullable()->comment('服务内容');
            $table->timestamp('times_at')->nullable()->comment('服务开始时间');
            $table->timestamp('times_end')->nullable()->comment('服务结束时间');
            $table->string('is_native')->default(0)->comment('是否要求本地？0不限');
            $table->string('age_at')->nullable()->comment('最小年龄');
            $table->string('age_end')->nullable()->comment('最大年龄');
            $table->string('day_at')->nullable()->comment('上户服务日期');
            $table->string('rest_mode')->default(0)->comment('休息方式');
            $table->text('other_requirements')->nullable()->comment('其他要求');
            $table->string('emergency')->default(0)->comment('加急？');
            $table->integer('offer_count')->default(0)->comment('报价次数');
            $table->integer('comments_count')->default(0)->comment('评论次数');
            $table->integer('likes_count')->default(0)->comment('点赞次数');
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
        Schema::dropIfExists('orders');
    }
}
