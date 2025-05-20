<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftdeletesInToubleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trouble', function (Blueprint $table) {
            $table->string('image')->after('keterangan');
            $table->softDeletes()->after('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trouble', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropSoftDeletes();
        });
    }
}
