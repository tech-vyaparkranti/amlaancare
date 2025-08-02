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
        Schema::create('font_master', function (Blueprint $table) {
            $table->id();
            $table->string('font_name',255)->unique("font_name_unique");
            $table->string('font_sample_image',255);
            $table->boolean('status');
            $table->unsignedBigInteger('created_by')->default(null)->nullable(true);
            $table->unsignedBigInteger('updated_by')->default(null)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('font_master');
    }
};
