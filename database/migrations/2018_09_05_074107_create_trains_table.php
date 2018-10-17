<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trains', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique()->nullable()->comment('UserId');
            $table->string('product_id')->nullable()->comment('分类专业ID');
            $table->decimal('price')->nullable()->comment('学费');
            $table->text('address')->nullable()->comment('培训地址');
            $table->text('content')->nullable()->comment('培训内容');
            $table->timestamp('times_at')->nullable()->comment('培训开始时间');
            $table->timestamp('times_next')->nullable()->comment('下一次培训时间');
            $table->timestamp('times_end')->nullable()->comment('培训结束时间');
            $table->string('rest_mode')->default(0)->comment('休息方式');
            $table->text('other_training')->nullable()->comment('其他培训');
            $table->string('emergency')->default(0)->comment('加急？');
            $table->integer('batch')->default(0)->comment('培训批次');
            $table->string('is_pay')->default('F')->comment('是否缴费');
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
        Schema::dropIfExists('trains');
    }
}
