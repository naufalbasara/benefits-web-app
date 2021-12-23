<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->char('pengurusID', 3)->primary();
            $table->string('nrp', 14);
            $table->char('divisiID', 3);
            $table->string('jabatan', 30);

            $table->foreign('nrp')->references('nrp')->on('anggota');
            $table->foreign('divisiID')->references('divisiID')->on('divisi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengurus');
    }
}
