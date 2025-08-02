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
        Schema::table('vendors', function (Blueprint $table) {
            // Add the new columns
            $table->string('city')->nullable();  // Add city
            $table->string('state')->nullable(); // Add state
            $table->string('pincode')->nullable(); // Add pincode
            $table->string('country')->nullable(); // Add country
            $table->string('pickup_location')->nullable(); // Add pickup_location
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            //
        });
    }
};
