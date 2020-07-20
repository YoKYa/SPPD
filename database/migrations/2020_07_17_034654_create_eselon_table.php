<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEselonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eselon', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->enum('nama_eselon',['Eselon II','Eselon III','PJFT Gol IV/c','Eselon IV','PJFT Gol IV/b','PJFT Gol IV/a','PJFT Gol III','Staf Gol IV/III','Staf Gol II/I', 'PTT S2/S3', 'PTT S1', 'PTT D3', 'PTT D1/SMK', 'PTT SMA','PTT SMP/SD'])->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eselon');
    }
}
