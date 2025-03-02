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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('grandfather_name')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->enum('marital_status', ['Single', 'Married', 'Divorced', 'Widowed']);
            $table->date('dob');
            $table->string('nationality')->default('Nepal');
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            // Identity Details
            $table->string('identity_type');
            $table->string('identity_number')->unique();
            $table->date('document_issued_date')->nullable();
            $table->string('document_front')->nullable();
            $table->string('document_back')->nullable();

            // Permanent Address
            $table->string('permanent_province');
            $table->string('permanent_district');
            $table->string('permanent_municipality');
            $table->string('permanent_street')->nullable();

            // Temporary Address
            $table->boolean('is_temporary_same')->default(false);
            $table->string('temporary_province')->nullable();
            $table->string('temporary_district')->nullable();
            $table->string('temporary_municipality')->nullable();
            $table->string('temporary_street')->nullable();

            $table->timestamps();
        });
    }

    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
