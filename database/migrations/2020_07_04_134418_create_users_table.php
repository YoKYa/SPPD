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
            $table->increments('id');
            $table->string('nama', 125);
            $table->string('nip', 20)->unique();
            $table->string('password', 255);
            $table->string('alamat', 255)->nullable();
            $table->date('tgllahir')->nullable();
            
            $table->enum('role',['Admin', 'Kepala Bidang', 'Kepala Seksi', 'Staff']);
            $table->tinyInteger('cek')->default('1');
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
        Schema::dropIfExists('users');
    }
}
