<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->comment('UserId');
            $table->string('country')->nullable()->comment('国家');
            $table->string('province')->nullable()->comment('省份');
            $table->string('city')->nullable()->comment('城市');
            $table->string('district')->nullable()->comment('区');
            $table->string('street')->nullable()->comment('街');
            $table->string('street_number')->nullable()->comment('号');
            $table->string('nation_code')->nullable()->comment('国家代码');
            $table->string('city_code')->nullable()->comment('城市代码');
            $table->string('adcode')->nullable()->comment('行政区ID');
            $table->string('latitude')->nullable()->comment('纬度');
            $table->string('longitude')->nullable()->comment('经度');
            $table->string('location_title')->nullable()->comment('坐标路名');
            $table->string('location_dir_desc')->nullable()->comment('坐标方向');
            $table->string('live_place')->nullable()->comment('现居地');
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
        Schema::dropIfExists('locations');
    }
}
