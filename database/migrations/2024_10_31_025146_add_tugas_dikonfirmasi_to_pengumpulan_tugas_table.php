<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->boolean('tugas_dikonfirmasi')->default(false)->after('catatan');
        });
    }

    public function down()
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            $table->dropColumn('tugas_dikonfirmasi');
        });
    }

};
