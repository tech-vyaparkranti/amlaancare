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
        Schema::create('purchase_management', function (Blueprint $table) {
            $table->id();
            $table->string('order_id',20)->unique("unique_order_id");
            $table->string('amount',20)->default("0");
            $table->string('currency_code',5)->default("INR");
            $table->enum('payment_type',['pre_paid','cod','complementary']);
            $table->enum('payment_status',['pending','inprocess','success','failed','retry']);
            $table->bigInteger("user_id",false,true)->index("purchase_user_id");
            $table->string('product_ids')->nullable(false);
            $table->text('payment_gateway_request')->nullable();
            $table->text('payment_gateway_response')->nullable();
            $table->string('payment_gateway_id')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->dateTime('purchase_start_date_time')->nullable();
            $table->dateTime('purchase_completion_date_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_management');
    }
};
