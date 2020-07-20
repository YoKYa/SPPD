<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngkutanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angkutan', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sppd_id');
            $table->enum('angkutan',['Angkutan Dinas','Angkutan Pribadi','Angkutan Umum','Angkutan Sewa'])->nullable();
            $table->enum('jenis',['Roda Dua','Roda Empat'])->nullable();
            $table->text('plat',10)->nullable();
            $table->enum('angkutan_umum',['Pesawat','Kereta','Kapal'])->nullable();
            $table->enum('sewa',['Roda Enam/Bus Besar','Roda Enam/Bus Sedang','Roda Empat/Bus Mini','Roda Empat','Roda Dua'])->nullable();
            $table->timestamps();

            $table->foreign('sppd_id')->references('id')->on('sppd')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angkutan');
    }
}
