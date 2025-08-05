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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['product_certificate', 'from_address', 'to_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // These lines add the columns back in case you need to roll back.
            // Adjust the data types and constraints to match their original definitions.
            $table->string('product_certificate')->nullable();
            $table->string('from_address')->nullable();
            $table->string('to_address')->nullable();
        });
    }
};