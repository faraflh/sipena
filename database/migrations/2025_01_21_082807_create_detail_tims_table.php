<?php

use App\Models\Aplikasi;
use App\Models\JabatanKegiatan;
use App\Models\Pegawai;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_tims', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(JabatanKegiatan::class);
            $table->foreignIdFor(Pegawai::class);
            $table->foreignIdFor(Aplikasi::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tims');
    }
};
