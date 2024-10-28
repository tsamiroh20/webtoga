<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferensisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('referensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tanaman_id');
            $table->foreign('tanaman_id')->references('id')->on('tanamen')->onDelete('cascade');
            $table->text('referensi');
            $table->text('pustaka');
            $table->timestamps();
        });
    } 
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referensis');
    }
};
