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
        Schema::table('vendor_registrations', function (Blueprint $table) {
            // Remove the video_path column
            $table->dropColumn('video_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendor_registrations', function (Blueprint $table) {
            // Re-add the video_path column (optional, in case you want to rollback)
            $table->string('video_path');
        });
    }
};
