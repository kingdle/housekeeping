<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->nullable()->comment('用户名');
            $table->string('email')->unique()->nullable()->comment('邮箱');
            $table->string('phone')->unique()->nullable()->comment('电话');;
            $table->string('password')->nullable();
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('weapp_openid')->nullable()->comment('小程序开放id');
            $table->string('weapp_session_key')->nullable()->comment('小程序session');
            $table->string('union_id')->unique()->nullable()->comment('微信unionid');
            $table->string('avatar')->nullable()->comment('微信头像');

            $table->string('avatar_url')->nullable()->comment('真实头像');
            $table->string('username')->nullable()->comment('真实姓名');
            $table->string('id_card')->unique()->nullable()->comment('身份号');
            $table->string('id_card_url')->nullable()->comment('身份原件');

            $table->integer('gender')->default(0)->comment('性别');
            $table->string('country')->default('中国')->comment('国家');
            $table->string('province')->nullable()->comment('省份');
            $table->string('city')->nullable()->comment('城市');
            $table->string('address')->nullable()->comment('身份证地址');
            $table->text('live_place')->nullable()->comment('现居住地址');
            $table->string('language')->default('zh_CN')->comment('语言');
            $table->string('confirmation_token')->nullable()->comment('认证token');
            $table->smallInteger('is_active')->default(0)->comment('是否注册家政人员');
            $table->smallInteger('is_subsidy')->default(0)->comment('是否享受补贴0不享受1失业2保险交满36个月');
            $table->integer('questions_count')->default(0)->comment('提问次数');
            $table->integer('answer_count')->default(0)->comment('解答次数');
            $table->integer('comments_count')->default(0)->comment('评论次数');
            $table->integer('likes_count')->default(0)->comment('点赞次数');
            $table->integer('followers_count')->default(0)->comment('被关注次数');
            $table->integer('followings_count')->default(0)->comment('关注其他人次数');
            $table->json('setting')->nullable()->comment('其他设置');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
