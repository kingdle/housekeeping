<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cycles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable()->comment('用户ID');
            $table->string('product_id')->nullable()->comment('培训分类ID');
            $table->string('title')->nullable()->comment('培训内容ID');
            $table->decimal('price')->nullable()->comment('培训价位');
            $table->string('period')->nullable()->comment('课时');
            $table->timestamp('times_at')->nullable()->comment('报名开始时间');
            $table->timestamp('times_end')->nullable()->comment('报名截止时间');
            $table->string('trains_count')->default('0')->comment('培训人数');
            $table->string('enrolments_count')->default('0')->comment('报名人数');
            $table->string('longitude')->nullable()->comment('经度');
            $table->string('latitude')->nullable()->comment('纬度');
            $table->string('address')->nullable()->comment('培训地址');
            $table->string('address_name')->nullable()->comment('详细地址');
            $table->string('linkman')->nullable()->comment('联系人');
            $table->string('phone')->nullable()->comment('联系电话');
            $table->text('remark')->nullable()->comment('备注');
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
        Schema::dropIfExists('cycles');
    }
}
