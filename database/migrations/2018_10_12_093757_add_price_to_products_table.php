<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price')->nullable()->after('icon')->comment('学费');
            $table->string('period')->nullable()->after('price')->comment('课时');
            $table->text('remark')->nullable()->after('period')->comment('备注');
            $table->string('status_type')->default('0')->after('remark')->comment('状态0培训1家政');
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
            $table->dropColumn('price');
            $table->dropColumn('period');
            $table->dropColumn('remark');
            $table->dropColumn('status_type');
        });
    }
}
