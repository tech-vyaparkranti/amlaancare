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
        if(!Schema::hasTable("collection_products_mapping")){
            Schema::create('collection_products_mapping', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger("product_id")->nullable(false)->index("cpm_product_id");
                $table->unsignedInteger("product_collection_id")->nullable(false)->index("cpm_pc_id");
                $table->tinyInteger("status")->default("1")->nullable(false);
                $table->timestamps();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('collection_products_mapping');
    }
};
