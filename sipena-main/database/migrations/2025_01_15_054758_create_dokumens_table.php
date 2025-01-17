<?php

use App\Models\Alur;
use App\Models\Kategori;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('idKategori');
//            $table->unsignedBigInteger('idAlur');
            $table->foreignIdFor(Kategori::class);
            $table->foreignIdFor(Alur::class);
            $table->string('jenisDokumen', 100);
            $table->timestamps();

//            $table->foreign('idKategori')->references('id')->on('kategoris')->onDelete('cascade');
//            $table->foreign('idAlur')->references('id')->on('alurs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
