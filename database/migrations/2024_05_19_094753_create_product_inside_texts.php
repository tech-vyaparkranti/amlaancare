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
        Schema::create('product_inside_texts', function (Blueprint $table) {
            $table->id();
            $table->string('text_type',50)->index("index_text_type");
            $table->integer('product_id')->index("index_product_inside_texts_product_id_id");
            $table->boolean('status')->default("1");
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
        Schema::dropIfExists('product_inside_texts');
    }
};
