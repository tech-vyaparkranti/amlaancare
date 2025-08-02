<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadProductCertificatesTable extends Migration
{
    public function up()
    {
        Schema::create('download_product_certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('product_name');
            $table->unsignedBigInteger('vendor_id');
            $table->string('certificate_url');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('download_product_certificates');
    }
}
