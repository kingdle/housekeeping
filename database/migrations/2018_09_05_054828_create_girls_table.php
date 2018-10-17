<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGirlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('girls', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique()->nullable()->comment('UserId');
            $table->string('number_id')->nullable()->comment('编号');
            $table->string('age')->nullable()->comment('年龄');
            $table->string('native_place')->nullable()->comment('籍贯');
            $table->string('education')->nullable()->comment('学历');
            $table->string('health_card')->nullable()->comment('健康证');
            $table->string('level')->nullable()->comment('级别');
            $table->decimal('price')->nullable()->comment('服务参考价');
            $table->string('service_times')->default(1)->comment('服务次数');
            $table->text('experience')->nullable()->comment('经历');
            $table->integer('pic_count')->default(0)->comment('相片数');
            $table->integer('order_count')->default(0)->comment('动态数');
            $table->timestamp('published_at')->nullable()->comment('上线日期');
            $table->string('code')->nullable()->comment('温馨大姐码');
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
        Schema::dropIfExists('girls');
    }
}
