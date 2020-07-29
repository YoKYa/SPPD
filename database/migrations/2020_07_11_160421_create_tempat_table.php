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
            $table->enum('tempat_berangkat',['Surabaya', 'Gresik', 'Sidoarjo', 'Mojokerto', 'Jombang', 'Bojonegoro', 'Lamongan', 'Tuban', 'Madiun', 'Ngawi', 'Magetan', 'Ponorogo', 'Pacitan', 'Kediri', 'Nganjuk', 'Tulungagung', 'Blitar', 'Trenggalek', 'Malang', 'Pasuruan', 'Probolinggo', 'Lumajang', 'Bondowoso', 'Situbondo', 'Jember', 'Banyuwangi', 'Bangkalan', 'Sampang', 'Pamekasan', 'Sumenep', 'Batu','Aceh','Sumatera Utara', 'Riau', 'Kep. Riau', 'Jambi', 'Sumatera Barat', 'Sumatera Selatan', 'Lampung', 'Bengkulu', 'Bangka Belitung', 'Banten', 'Jawa Barat','D.K.I Jakarta','Jawa Tengah','D.I Jogjakarta', 'Jawa Timur','Bali','Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Kalimantan Barat', 'Kalimantan Tengah','Kalimantan Selatan','Kalimantan Timur','Kalimantan Utara','Sulawesi Utara','Gorontalo','Sulawesi Barat','Sulawesi Selatan', 'Sulawesi Tengah','Sulawesi Tenggara','Maluku','Maluku Utara','Papua','Papua Barat']);
            $table->enum('tempat_tujuan',['Surabaya', 'Gresik', 'Sidoarjo', 'Mojokerto', 'Jombang', 'Bojonegoro', 'Lamongan', 'Tuban', 'Madiun', 'Ngawi', 'Magetan', 'Ponorogo', 'Pacitan', 'Kediri', 'Nganjuk', 'Tulungagung', 'Blitar', 'Trenggalek', 'Malang', 'Pasuruan', 'Probolinggo', 'Lumajang', 'Bondowoso', 'Situbondo', 'Jember', 'Banyuwangi', 'Bangkalan', 'Sampang', 'Pamekasan', 'Sumenep', 'Batu','Aceh','Sumatera Utara', 'Riau', 'Kep. Riau', 'Jambi', 'Sumatera Barat', 'Sumatera Selatan', 'Lampung', 'Bengkulu', 'Bangka Belitung', 'Banten', 'Jawa Barat','D.K.I Jakarta','Jawa Tengah','D.I Jogjakarta', 'Jawa Timur','Bali','Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'Kalimantan Barat', 'Kalimantan Tengah','Kalimantan Selatan','Kalimantan Timur','Kalimantan Utara','Sulawesi Utara','Gorontalo','Sulawesi Barat','Sulawesi Selatan', 'Sulawesi Tengah','Sulawesi Tenggara','Maluku','Maluku Utara','Papua','Papua Barat']);
            $table->timestamps();

            $table->foreign('sppd_id')->references('id')->on('sppd')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tempat');
    }
}