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
        Schema::table('konsultasi', function (Blueprint $table) {
            // Modify the existing status column to include 'pending' and set it as default
            $table->enum('status', ['pending', 'not complete', 'on going', 'complete'])
                  ->default('pending') // Set the default status to 'pending'
                  ->change(); // Ensure you're modifying the existing column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            // Revert the status column back to its previous state
            $table->enum('status', ['not complete', 'on going', 'complete'])
                  ->default('not complete') // Restore the original default status
                  ->change();
        });
    }
    
};
