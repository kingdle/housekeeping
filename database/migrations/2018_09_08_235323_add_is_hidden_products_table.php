<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsHiddenProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('services_count')->default(0)->after('hot')->comment('服务人数');
            $table->integer('comments_count')->default(0)->after('services_count')->comment('评论数');
            $table->integer('followers_count')->default(1)->after('comments_count')->comment('点赞数');
            $table->integer('answers_count')->default(0)->after('followers_count')->comment('回复数');
            $table->string('is_hidden')->default('F')->after('answers_count')->comment('隐藏');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('services_count');
            $table->dropColumn('comments_count');
            $table->dropColumn('followers_count');
            $table->dropColumn('answers_count');
            $table->dropColumn('is_hidden');
        });
    }
}
