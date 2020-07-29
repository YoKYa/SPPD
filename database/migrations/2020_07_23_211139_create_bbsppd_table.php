<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBbsppdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bbsppd', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sppd_id');
            $table->text('skpd')->nullable();
            $table->text('program')->nullable();
            $table->text('kegiatan')->nullable();
            $table->text('rekening')->nullable();
            $table->timestamps();

            $table->foreign('sppd_id')->references('id')->on('sppd')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bbsppd');
    }
}
