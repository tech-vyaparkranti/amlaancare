<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('supply_chains', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Store title of the content
        $table->text('content'); // Store the content text (could be HTML)
        $table->string('image'); // Store image file path (relative to storage)
        $table->json('faq'); // Store FAQ as a JSON array
        $table->enum('status', ['active', 'disabled'])->default('active'); // Manage content status
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_chains');
    }
};
