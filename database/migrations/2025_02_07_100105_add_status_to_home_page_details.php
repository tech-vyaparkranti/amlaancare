<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToHomePageDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_page_details', function (Blueprint $table) {
            // Adding the 'status' column with a default value 'enabled'
            $table->enum('status', ['enabled', 'disabled'])->default('enabled')->after('message_from_founder');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_page_details', function (Blueprint $table) {
            // Drop the 'status' column in case of rollback
            $table->dropColumn('status');
        });
    }
}
