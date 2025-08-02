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
            $table->json('about_us_images')->nullable(); // Add a column for multiple images as JSON
        });
    }
    
    public function down()
    {
        Schema::table('home_page_details', function (Blueprint $table) {
            $table->dropColumn('about_us_images');
        });
    }
    
};
