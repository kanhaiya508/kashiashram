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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // Enter Your Name
            $table->string('gothra');             // Enter Your Gothra
            $table->string('donor_name');         // Donor Name
            $table->string('occasion');           // Occasion
            $table->decimal('donation_amount', 10, 2)->nullable(); // Donation Amount
            $table->date('donation_date')->nullable();             // Date (mm/dd/yyyy)
            $table->string('contact_details');    // Contact Details
            $table->string('contact_number');     // Contact Number
            $table->string('email')->nullable();  // Your Email
            $table->text('note')->nullable();     // Note to Ashram
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
