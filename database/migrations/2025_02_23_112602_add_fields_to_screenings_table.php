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
        Schema::table('screenings', function (Blueprint $table) {
            $table->timestamp('screening_date')->nullable(); // Screening date for filtering
            $table->integer('remaining_seats')->nullable(); // Remaining available seats
            // $table->enum('payment_status', ['pending', 'unpaid', 'paid'])->default('pending');

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('screenings', function (Blueprint $table) {
            //
        });
    }
};
