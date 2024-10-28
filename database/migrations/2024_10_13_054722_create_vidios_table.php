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
        Schema::create('vidios', function (Blueprint $table) {
            $table->id();
            
            // Menambahkan foreign key tanaman_id untuk relasi dengan tabel 'tanaman'
            $table->foreignId('tanaman_id')->constrained('tanamen')->onDelete('cascade');
            
            // Kolom untuk menyimpan URL video
            $table->string('video_url');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */ 
    public function down(): void
    {
        Schema::dropIfExists('vidios');
    }
};
