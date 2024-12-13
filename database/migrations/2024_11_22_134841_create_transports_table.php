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
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade'); // Link to routes
            $table->enum('type', ['bus', 'plane', 'train']);
            $table->string('name'); // Vehicle name/identifier
            $table->date('departure_date');
            $table->time('departure_time');
            $table->integer('capacity')->unsigned(); // Maximum number of seats
            $table->decimal('ticket_price',8, 2); // Price for each seat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
