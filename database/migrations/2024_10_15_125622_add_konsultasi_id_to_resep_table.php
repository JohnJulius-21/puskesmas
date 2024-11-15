<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('resep', function (Blueprint $table) {
            // Add the column as nullable first
            $table->unsignedBigInteger('konsultasi_id')->nullable()->after('obat_id');
        });

        // Populate existing records with a related konsultasi_id
        $existingResep = DB::table('resep')->get();

        foreach ($existingResep as $resep) {
            // Replace this logic with the actual logic to get the correct konsultasi_id
            // This example assumes you have a patient_id in the resep table to find related konsultasi
            $konsultasi = DB::table('konsultasi')
                ->where('patients_id', $resep->patient_id) // Adjust based on your field names
                ->first();

            if ($konsultasi) {
                DB::table('resep')
                    ->where('id', $resep->id) // Update the current resep
                    ->update(['konsultasi_id' => $konsultasi->id]);
            }
        }

        // Now add the foreign key constraint
        Schema::table('resep', function (Blueprint $table) {
            $table->foreign('konsultasi_id')->references('id')->on('konsultasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
        Schema::table('resep', function (Blueprint $table) {
            $table->dropForeign(['konsultasi_id']);
            $table->dropColumn('konsultasi_id');
        });
    }
};
