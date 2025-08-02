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
            // Dropping the 'about_us_image' column
            $table->dropColumn('about_us_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('home_page_details', function (Blueprint $table) {
            // Re-adding the 'about_us_image' column (if you need to revert this change)
            $table->string('about_us_image')->nullable();
        });
    }
};
