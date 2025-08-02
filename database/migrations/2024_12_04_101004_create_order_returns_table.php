<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_returns', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->foreignId('order_id')->constrained()->onDelete('cascade');  // Foreign key to orders table
            $table->string('return_status')->default('pending');  // Default status for the return
            $table->text('return_reason');  // Reason for return
            $table->text('pickup_address');  // Pickup address for return
            $table->string('video_proof')->nullable();  // Optional video proof file path
            $table->timestamps();  // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_returns');
    }
}
