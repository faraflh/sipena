<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->bigInteger('nip');
            $table->bigInteger('nomor_telepon');
            $table->string('nama_opd');
            $table->string('nama_aplikasi');
            $table->string('email');
            $table->string('status')->nullable(); 
            $table->string('generate_code')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
