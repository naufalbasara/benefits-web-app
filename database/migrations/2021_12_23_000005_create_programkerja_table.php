<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programkerja', function (Blueprint $table) {
            $table->char('prokerID', 4)->primary();
            $table->char('pengurusID', 3);
            $table->char('divisiID', 3);
            $table->char('danaID', 5)->nullable();
            $table->string('namaProker', 30);
            $table->date('tanggalKegiatan');
            $table->enum('status', ['Belum', 'Sedang', 'Sudah']);

            $table->foreign('pengurusID')->references('pengurusID')->on('pengurus');
            $table->foreign('divisiID')->references('divisiID')->on('divisi');
            $table->foreign('danaID')->references('danaID')->on('dana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programkerja');
    }
}
