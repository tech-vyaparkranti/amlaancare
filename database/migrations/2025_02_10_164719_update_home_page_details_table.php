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
        Schema::table('home_page_details', function (Blueprint $table) {
            // Drop the 'desktop_video' and 'mobile_video' columns
            $table->dropColumn(['desktop_video', 'mobile_video']);
            
            // Add the 'slider_images' column for multiple images
            $table->json('slider_images')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('home_page_details', function (Blueprint $table) {
            // Add back the 'desktop_video' and 'mobile_video' columns
            $table->string('desktop_video')->nullable();
            $table->string('mobile_video')->nullable();
            
            // Drop the 'slider_images' column
            $table->dropColumn('slider_images');
        });
    }
};
