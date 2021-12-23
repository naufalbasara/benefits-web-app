<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dana', function (Blueprint $table) {
            $table->char('danaID', 5)->unique()->primary();
            $table->enum('tipeTransaksi', ['DanaMasuk', 'DanaKeluar']);
            $table->int('biaya');
            $table->date('tanggalTransaksi')->nullable();
            $table->string('sumber', 30)->nullable();
            $table->string('keperluan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dana');
    }
}
