<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificationsTable extends Migration
{
    public function up()
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('image')->nullable(); // Image path (nullable in case no image is uploaded)
            $table->enum('status', ['active', 'inactive'])->default('inactive'); // Certification status
            $table->integer('serial')->default(0); // Sorting field
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('certifications');
    }
}
