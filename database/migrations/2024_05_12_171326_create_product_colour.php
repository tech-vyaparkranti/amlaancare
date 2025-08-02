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
        Schema::create('product_colours', function (Blueprint $table) {
            $table->id();
            $table->integer('colour_master_id')->index("index_colour_master_id");
            $table->integer('product_id')->index("index_product_id_id");
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
        Schema::dropIfExists('product_colour');
    }
};
