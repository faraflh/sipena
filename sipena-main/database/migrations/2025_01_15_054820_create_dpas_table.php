<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dpas', function (Blueprint $table) {
            $table->id();
            $table->integer('noSPT');
            $table->integer('noSPPD');
            $table->string('tujuan', 255);
            $table->integer('noRek');
            $table->integer('noDPA');
            $table->string('subKeg', 255);
            $table->year('tahun');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dpas');
    }
};
