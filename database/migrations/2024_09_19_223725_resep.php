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
        Schema::create('resep', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('obat_id');
            $table->string('laporan');
            $table->string('catatan');
            $table->timestamps();

            // Menambahkan foreign key constraints
            $table->foreign('patient_id')->references('id')->on('pasien')->onDelete('cascade');
            $table->foreign('obat_id')->references('id')->on('obat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep');
        
    }
};
