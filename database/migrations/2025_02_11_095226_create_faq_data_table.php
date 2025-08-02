<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqDataTable extends Migration
{
    public function up()
    {
        Schema::create('faq_data', function (Blueprint $table) {
            $table->id();
            // The faq column will store the array of questions and answers in JSON format
            $table->json('faq'); // Store FAQs as JSON array
            $table->enum('status', ['enabled', 'disabled'])->default('enabled'); // The status column
            $table->timestamps(); // Automatically managed timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('faq_data'); // Drop the table if rolling back the migration
    }
}
