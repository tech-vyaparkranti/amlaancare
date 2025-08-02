<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReturnColumnsToShipRocketManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ship_rocket_management', function (Blueprint $table) {
            $table->string('return_status')->nullable()->default('pending'); // For return status
            $table->text('return_reason')->nullable(); // For the return reason
            $table->text('return_response')->nullable(); // For storing the response data
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ship_rocket_management', function (Blueprint $table) {
            $table->dropColumn(['return_status', 'return_reason', 'return_response']);
        });
    }
}
