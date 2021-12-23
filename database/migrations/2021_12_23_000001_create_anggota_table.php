<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->string('nrp', 14)->unique()->primary();
            $table->string('departemen', 50);
            $table->string('nama', 50);
            $table->char('angkatan', 4);
            $table->enum('gender', ['L', 'P']);
            $table->string('alamat', 50);
            $table->string('asalSekolah', 50);
            $table->string('noHp', 15);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
