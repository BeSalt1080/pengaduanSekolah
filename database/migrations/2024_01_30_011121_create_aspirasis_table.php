<?php

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
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();
            $table->char('nis',10);
            $table->foreignId('kategori_id')->constrained()->onDelete('cascade');
            $table->string('foto');
            $table->string('lokasi');
            $table->string('keterangan');
            $table->enum('status', ['Menunggu','Proses','Selesai'])->default('Menunggu');
            $table->timestamps();
            $table->foreign('nis')->references('nis')->on('siswas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};
