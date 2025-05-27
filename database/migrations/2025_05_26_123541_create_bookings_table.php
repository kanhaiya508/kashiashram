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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gothra')->nullable();
            $table->string('user_type')->nullable(); // Donar, General
            $table->string('travel_type')->nullable(); // Bus, Train etc.
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('aadhar')->nullable();
            $table->text('message')->nullable();
            $table->date('booking_from');
            $table->date('booking_to');
            $table->enum('status', ['booked', 'cancelled', 'completed'])->default('booked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
