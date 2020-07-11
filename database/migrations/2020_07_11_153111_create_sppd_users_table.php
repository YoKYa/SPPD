<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSppdUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppd_users', function (Blueprint $table) {
            $table->unsignedInteger('sppd_id');
            $table->unsignedInteger('users_id');

            $table->primary(['sppd_id','users_id']);
            $table->foreign('users_id')->references('id')->on('users')->onDelete('NO ACTION');
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
        Schema::dropIfExists('sppd_users');
    }
}
