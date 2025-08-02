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
        Schema::create('batches', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for each batch record
            $table->string('batch_number')->unique(); // Unique batch number
            $table->string('batch_name'); // Name of the batch
            $table->date('start_date'); // Start date of the batch
            $table->string('pdf_url')->nullable(); // URL to the associated PDF, nullable in case no PDF exists
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status of the batch (active or inactive)
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
