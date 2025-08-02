<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExitsTable extends Migration
{
    public function up()
    {
        Schema::create('user_exits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // For tracking logged-in users
            $table->string('url'); // URL of the page the user exited
            $table->timestamp('timestamp'); // Timestamp when the exit occurred
            $table->timestamps(); // Created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_exits');
    }
}
