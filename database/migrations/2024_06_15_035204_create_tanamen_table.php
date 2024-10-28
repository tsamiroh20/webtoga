<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanamenTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tanamen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_latin', 255);
            $table->string('nama_ilmiah', 255);
            $table->text('deskripsi')->nullable();
            $table->text('khasiat')->nullable();
            $table->text('kandungan_zat')->nullable();
            $table->text('dosis')->nullable();
            $table->text('perhatian')->nullable();
            $table->text('cara_budidaya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanamen');
    }
};
