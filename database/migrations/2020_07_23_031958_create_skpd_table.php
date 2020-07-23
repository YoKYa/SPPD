<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpdTable extends Migration
{
    public function up()
    {
        Schema::create('skpd', function (Blueprint $table) {
            $table->id();
            $table->text('skpd');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('skpd');
    }
}
