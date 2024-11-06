<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasUserTable extends Migration
{
    public function up()
    {
        Schema::create('kelas_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('kelas_id')->constrained()->onDelete('cascade');
            $table->string('jurusan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelas_user');
    }
};
