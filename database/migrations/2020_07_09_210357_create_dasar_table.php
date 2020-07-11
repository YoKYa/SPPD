<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDasarTable extends Migration
{
    public function up()
    {
        Schema::create('dasar', function (Blueprint $table) {
            $table->id();
            $table->text('dasar');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('dasar');
    }
}
