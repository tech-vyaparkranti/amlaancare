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
            $table->string('take_inside_text', 10)->nullable()->after("product_type");
            $table->integer('inside_text_price')->nullable()->after("take_inside_text");
            $table->string('gift_wrap_option', 10)->nullable()->after("inside_text_price");
            $table->integer('gift_wrap_option_price')->nullable()->after("gift_wrap_option");
            $table->string('rush_service', 10)->nullable()->after("gift_wrap_option_price");
            $table->integer('rush_service_price')->nullable()->after("rush_service");
            $table->string('custom_design_option', 10)->nullable()->after("rush_service_price");
            $table->integer('custom_design_option_price')->nullable()->after("custom_design_option");
            $table->string('special_instructions', 10)->nullable()->after("custom_design_option_price");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
