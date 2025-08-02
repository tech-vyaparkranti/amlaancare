<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vendor_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('business_name');
            $table->string('mobile_number');
            $table->string('email')->unique();
            $table->string('gstin')->nullable();
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country');
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->string('ifsc_code');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('cancelled_cheque');
            $table->string('gst_certificate');
            $table->string('video_path');
            $table->string('password');
            $table->boolean('whatsapp_consent')->default(false);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_registrations');
    }
};
