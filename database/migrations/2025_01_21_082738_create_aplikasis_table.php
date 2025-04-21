<?php

use App\Models\DetailAlur;
use App\Models\DetailDokumen;
use App\Models\DetailTim;
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
        Schema::create('aplikasis', function (Blueprint $table) {
            $table->id();
            $table->string('namaAplikasi', 255);
            $table->string('keterangan', 255);
            $table->foreignIdFor(DetailTim::class)->nullable();
            $table->foreignIdFor(DetailDokumen::class)->nullable();
            $table->foreignIdFor(DetailAlur::class)->nullable();
            $table->string('url', length: 255);
            $table->string('status', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aplikasis');
    }
};
