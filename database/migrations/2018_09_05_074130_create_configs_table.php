<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->comment('学校名');
            $table->text('summary')->nullable()->comment('优势简介');
            $table->text('content')->nullable()->comment('专业介绍');
            $table->string('property')->nullable()->comment('性质');
            $table->string('avatar')->nullable()->comment('头像');
            $table->integer('pic')->default(0)->comment('荣耀照片');
            $table->string('address')->comment('所在地址');
            $table->timestamp('published_at')->comment('上线日期');
            $table->string('code')->nullable()->comment('学校小程序码');
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
        Schema::dropIfExists('configs');
    }
}
