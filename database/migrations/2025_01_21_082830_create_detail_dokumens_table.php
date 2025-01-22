<?php

use App\Models\Aplikasi;
use App\Models\Dokumen;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('namaDokumen', 255);
            $table->string('file');
            $table->foreignIdFor(Aplikasi::class);
            $table->foreignIdFor(Dokumen::class);
            $table->integer('noSurat');
            $table->string('perihal', 255);
            $table->date('tanggalSurat');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('detail_dokumens');
    }
};
