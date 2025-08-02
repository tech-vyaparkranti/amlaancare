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
    Schema::create('home_page_details', function (Blueprint $table) {
        $table->id();
        $table->string('desktop_video')->nullable();
        $table->string('mobile_video')->nullable();
        $table->string('about_us_image')->nullable();
        $table->text('about_us_short_description')->nullable();
        $table->string('founder_name');
        $table->string('founder_image')->nullable();
        $table->text('message_from_founder')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_page_details');
    }
};
