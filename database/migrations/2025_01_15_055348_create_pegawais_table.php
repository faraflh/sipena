<?php

use App\Models\Golongan;
use App\Models\JabatanPegawai;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip_nik', 20);
            $table->string('nama', 255);
            $table->string('namaRek', 255);
            $table->integer('noRek');
            $table->string('bank', 255);
//            $table->unsignedBigInteger('idGol');
//            $table->unsignedBigInteger('idJabatanPegawai');
            $table->foreignIdFor(Golongan::class);
            $table->foreignIdFor(JabatanPegawai::class);
            $table->string('email', 255);
            $table->timestamps();

//            $table->foreign('idGol')->references('id')->on('golongans')->onDelete('cascade');
//            $table->foreign('idJabatanPegawai')->references('id')->on('jabatan_pegawais')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
