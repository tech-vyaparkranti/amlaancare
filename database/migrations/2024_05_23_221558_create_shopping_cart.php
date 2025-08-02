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
        Schema::create('shopping_cart', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id")->index("shopping_cart_product_id");
            $table->integer("qantity");
            $table->string("price",100);
            $table->text("variant_options")->nullable(true);
            $table->text("product_info")->nullable(true);
            $table->text("special_instructions")->nullable(true);
            $table->string("status",10)->default("in_cart");//purchased
            $table->unsignedBigInteger("user_id")->nullable(true)->index("shopping_user_id");
            $table->string("temp_session_id")->nullable(true)->index("shopping_temp_session_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart');
    }
};
