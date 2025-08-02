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
        Schema::create('product_font', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->index("product_id_index");
            $table->integer("font_id")->index("font_id_index");
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
        Schema::dropIfExists('product_font');
    }
};
