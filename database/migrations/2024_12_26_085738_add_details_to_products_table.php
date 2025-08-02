<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->float('length')->nullable()->after('updated_at');  // Length of the product
            $table->float('breadth')->nullable()->after('length');  // Breadth of the product
            $table->float('height')->nullable()->after('breadth');  // Height of the product
            $table->float('weight')->nullable()->after('height');  // Weight of the product
            $table->string('hsn_code', 20)->nullable()->after('weight');  // HSN code for the product
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['length', 'breadth', 'height', 'weight', 'hsn_code']);
        });
    }
}
