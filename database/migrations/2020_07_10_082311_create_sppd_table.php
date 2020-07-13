<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSppdTable extends Migration
{
    public function up()
    {
        Schema::create('sppd', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('no_surat');
            $table->year('tahun_surat');
            $table->date('tgl_surat')->default(now());
            $table->date('tgl_pergi');
            $table->date('tgl_kembali');
            $table->string('acara');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('sppd');
        Schema::dropIfExists('sppd_users');

    }
}
