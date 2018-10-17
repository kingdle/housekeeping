<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressComponentUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('district')->nullable()->after('city')->comment('区');
            $table->string('street')->nullable()->after('district')->comment('街');
            $table->string('nation_code')->nullable()->after('street')->comment('国家代码');
            $table->string('city_code')->nullable()->after('nation_code')->comment('城市代码');
            $table->string('latitude')->nullable()->after('city_code')->comment('纬度');
            $table->string('longitude')->nullable()->after('latitude')->comment('经度');
            $table->string('location_title')->nullable()->after('longitude')->comment('坐标路名');
            $table->string('location_dir_desc')->nullable()->after('location_title')->comment('坐标方向');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('district');
            $table->dropColumn('street');
            $table->dropColumn('nation_code');
            $table->dropColumn('city_code');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
            $table->dropColumn('location_title');
            $table->dropColumn('location_dir_desc');
        });
    }
}
