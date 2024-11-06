<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterisTable extends Migration
{
    public function up()
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul materi
            $table->text('deskripsi'); // Deskripsi materi
            $table->string('file')->nullable(); // File materi (optional)
            $table->string('url')->nullable(); // Tambahkan kolom URL
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('materis');
    }
}