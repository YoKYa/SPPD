<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempatTable extends Migration
{
    public function up()
    {
        Schema::create('tempat', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sppd_id');
            $table->enum('tempat_berangkat',['Surabaya', 'Gresik', 'Sidoarjo', 'Mojokerto', 'Jombang', 'Bojonegoro', 'Lamongan', 'Tuban', 'Madiun', 'Ngawi', 'Magetan', 'Ponorogo', 'Pacitan', 'Kediri', 'Nganjuk', 'Tulungagung', 'Blitar', 'Trenggalek', 'Malang', 'Pasuruan', 'Probolinggo', 'Lumajang', 'Bondowoso', 'Situbondo', 'Jember', 'Banyuwangi', 'Bangkalan', 'Sampang', 'Pamekasan', 'Sumenep', 'Batu','Last']);
            $table->enum('tempat_tujuan',['Surabaya', 'Gresik', 'Sidoarjo', 'Mojokerto', 'Jombang', 'Bojonegoro', 'Lamongan', 'Tuban', 'Madiun', 'Ngawi', 'Magetan', 'Ponorogo', 'Pacitan', 'Kediri', 'Nganjuk', 'Tulungagung', 'Blitar', 'Trenggalek', 'Malang', 'Pasuruan', 'Probolinggo', 'Lumajang', 'Bondowoso', 'Situbondo', 'Jember', 'Banyuwangi', 'Bangkalan', 'Sampang', 'Pamekasan', 'Sumenep', 'Batu','Last']);
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
        Schema::dropIfExists('tempat');
    }
}
