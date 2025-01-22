<?php

use App\Models\Alur;
use App\Models\Aplikasi;
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
        Schema::create('detail_alurs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Aplikasi::class);
            $table->foreignIdFor(Alur::class);
            $table->string('keterangan_alur', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_alurs');
    }
};
