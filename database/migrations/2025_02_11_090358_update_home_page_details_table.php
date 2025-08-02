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
            // Remove slider_images column
            $table->dropColumn('slider_images');

            // Add desktop_video and mobile_video columns
            $table->string('desktop_video')->nullable();  // For desktop video URL
            $table->string('mobile_video')->nullable();   // For mobile video URL
        });
    }

    public function down()
    {
        Schema::table('home_page_details', function (Blueprint $table) {
            // Revert the changes in case of rollback
            $table->json('slider_images')->nullable();  // Add slider_images back
            $table->dropColumn('desktop_video');
            $table->dropColumn('mobile_video');
        });
    }
};
