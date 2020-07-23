<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBebanbiayaTable extends Migration
{
    public function up()
    {
        Schema::create('bebanbiaya', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('bebanbiaya');
    }
}
