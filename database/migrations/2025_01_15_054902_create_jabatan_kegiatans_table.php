<?php

use App\Models\Kategori;
use App\Models\Pegawai;
use App\Models\JabatanStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jabatan_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pegawai::class);
            $table->foreignIdFor(Kategori::class);
            $table->foreignIdFor(JabatanStatus::class);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jabatan_kegiatans');
    }
};
