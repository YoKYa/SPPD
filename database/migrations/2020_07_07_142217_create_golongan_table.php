<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGolonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('golongan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('golongan',['Juru Muda (I/a)','Juru Muda Tingkat I (I/b)','Juru (I/c)','Juru Tingkat I (I/d)','Pengatur Muda (II/a)','Pengatur Muda Tingkat I (II/b)','Pengatur (II/c)','Pengatur Tingkat I (II/d)','Penata Muda (III/a)','Penata Muda Tingkat I (III/b)','Penata (III/c)','Penata Tingkat I (III/d)','Pembina (IV/a)','Pembina Tingkat I (IV/b)','Pembina Utama Muda (IV/c)','Pembina Utama Madya (IV/d)','Pembina Utama (IV/e)'])->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('golongan');
    }
}
