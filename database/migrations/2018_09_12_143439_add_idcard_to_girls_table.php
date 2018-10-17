<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdcardToGirlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('girls', function (Blueprint $table) {
            $table->string('username')->nullable()->after('number_id')->comment('真实姓名');
            $table->string('id_card')->nullable()->after('username')->comment('身份号');
            $table->string('id_card_front')->nullable()->after('id_card')->comment('身份证正面');
            $table->string('id_card_back')->nullable()->after('id_card_front')->comment('身份证反面');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('girls', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('id_card');
            $table->dropColumn('id_card_front');
            $table->dropColumn('id_card_back');
        });
    }
}
