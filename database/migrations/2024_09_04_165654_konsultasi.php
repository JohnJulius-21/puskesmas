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
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('pasien')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('dokters')->onDelete('cascade');
            $table->string('jenis_kelamin');
            $table->dateTime('tanggal_konsultasi');
            $table->string('keluhan');
            $table->string('riwayat');
            $table->integer('queue')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
