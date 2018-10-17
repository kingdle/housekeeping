<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdCardToTrainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trains', function (Blueprint $table) {
            $table->string('username')->nullable()->after('user_id')->comment('真实姓名');
            $table->string('id_card')->nullable()->after('username')->comment('身份号');
            $table->string('id_card_front')->nullable()->after('id_card')->comment('身份证正面');
            $table->string('id_card_back')->nullable()->after('id_card_front')->comment('身份证反面');
            $table->string('real_head')->nullable()->after('id_card_back')->comment('真实头像');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trains', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('id_card');
            $table->dropColumn('id_card_front');
            $table->dropColumn('id_card_back');
            $table->dropColumn('real_head');
        });
    }
}
