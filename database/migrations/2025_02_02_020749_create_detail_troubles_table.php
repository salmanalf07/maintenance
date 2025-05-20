<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTroublesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_troubles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('troubleId');
            $table->string('mtcId');
            $table->dateTime('mulaiPerbaikan');
            $table->dateTime('selesaiPerbaikan')->nullable();
            $table->string('tindakanPerbaikan')->nullable();
            $table->string('analisa')->nullable();
            $table->string('tindakan')->nullable();
            $table->string('catatan')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('detail_troubles');
    }
}
