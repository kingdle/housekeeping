<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEducationIdToGirlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('girls', function (Blueprint $table) {
            $table->string('education_id')->nullable()->after('native_place')->comment('学历编号');
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
            $table->dropColumn('education_id');
        });
    }
}
