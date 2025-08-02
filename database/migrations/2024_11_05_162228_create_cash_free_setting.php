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
        Schema::create('cash_free_setting', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->enum('mode',['live','testing'])->default("testing")->nullable(false);
            $table->string('country_name');
            $table->string('currency_name');
            $table->double('currency_rate');
            $table->text('cash_free_client_id');
            $table->text('cash_free_secret_key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_free_setting');
    }
};
