<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDasarSuratTable extends Migration
{
    public function up()
    {
        Schema::create('dasar_surat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sppd_id');
            $table->text('dasar_surat');
            $table->timestamps();

            $table->foreign('sppd_id')->references('id')->on('sppd')->onDelete('NO ACTION');
        });
    }
    public function down()
    {
        Schema::dropIfExists('dasar_surat');
    }
}
