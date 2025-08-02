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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_url')->nullable();
            $table->string('og_type')->nullable();
            $table->string('og_site_url')->nullable();
            $table->string('canonical')->nullable();
            $table->string('og_local')->nullable();
            $table->string('robots')->nullable();
            $table->string('site_map')->nullable();    

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
             $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_keyword');
            $table->dropColumn('og_title');
            $table->dropColumn('og_url');
            $table->dropColumn('og_type');
            $table->dropColumn('og_site_url');
            $table->dropColumn('canonical');
            $table->dropColumn('og_local');
            $table->dropColumn('site_map');
            $table->dropColumn('robots');
        });
    }
};
