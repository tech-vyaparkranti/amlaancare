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
        if(!Schema::hasTable("product_collection_master")){
            Schema::create('product_collection_master', function (Blueprint $table) {
                $table->id();
                $table->string('collection_name',500)->unique("collection_name_unique")->nullable(false);
                $table->text('collection_image')->nullable(false);
                $table->integer("sort_number")->nullable(false)->index("index_sn_pc");
                $table->tinyInteger("status")->default("1")->nullable(false);
                $table->unsignedBigInteger('created_by')->default(null)->nullable(true);
                $table->unsignedBigInteger('updated_by')->default(null)->nullable(true);
                $table->timestamps();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('product_collection_master');
    }
};
