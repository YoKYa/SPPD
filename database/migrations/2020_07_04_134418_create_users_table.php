<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 125);
            $table->string('nip', 20)->unique();
            $table->string('alamat', 255)->nullable();
            $table->string('password', 255);
            $table->date('tgllahir')->nullable();
            $table->enum('golongan',['Juru Muda (I/a)','Juru Muda Tingkat I (I/b)','Juru (I/c)','Juru Tingkat I (I/d)','Pengatur Muda (II/a)','Pengatur Muda Tingkat I (II/b)','Pengatur (II/c)','Pengatur Tingkat I (II/d)','Penata Muda (III/a)','Penata Muda Tingkat I (III/b)','Penata (III/c)','Penata Tingkat I (III/d)','Pembina (IV/a)','Pembina Tingkat I (IV/b)','Pembina Utama Muda (IV/c)','Pembina Utama Madya (IV/d)','Pembina Utama (IV/e)'])->nullable();
            $table->string('jabatan',100)->nullable(); 
            $table->enum('role',['Admin', 'Kepala Bidang', 'Kepala Seksi', 'Staff']);
            $table->timestamps();
            $table->tinyInteger('cek')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
