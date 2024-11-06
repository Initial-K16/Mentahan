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
        // create_kelas_materi_table
        Schema::create('kelas_materi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained()->onDelete('cascade');
            $table->foreignId('materi_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_materi');
    }
};
