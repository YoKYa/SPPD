<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNosuratTable extends Migration
{
    public function up()
    {
        Schema::create('no_surat', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('no_surat')->default(1);
            $table->year('tahun_surat');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('no_surat');
    }
}
