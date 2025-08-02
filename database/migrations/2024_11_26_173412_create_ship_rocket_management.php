<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *  
     */
    public function up(): void
    {
        if(!Schema::hasTable("ship_rocket_management")){
            Schema::create('ship_rocket_management', function (Blueprint $table) {
                $table->id();
                $table->string("order_id",50)->index("order_id_srm")->nullable(false);
                $table->dateTime("order_date")->index("order_date_srm")->nullable(false);
                $table->string("pickup_location",255)->nullable(false);
                $table->string("reseller_name",255)->nullable()->default(null);
                $table->string("company_name",255)->nullable()->default(null);
                $table->integer("channel_id")->nullable()->default(null);
                $table->string("billing_customer_name",255)->nullable(false);
                $table->string("billing_last_name",255)->nullable()->default(null);
                $table->string("billing_address",255)->nullable(false);
                $table->string("billing_address_2",255)->nullable()->default(null);
                $table->string("billing_city",35)->nullable(false);
                $table->integer("billing_pincode")->nullable(false);
                $table->string("billing_state",50)->nullable(false);
                $table->string("billing_country",50)->nullable(false);
                $table->string("billing_email",255)->nullable(false);
                $table->string("billing_phone",20)->nullable(false);
                $table->string("billing_alternate_phone",20)->nullable(true)->default(null);
                $table->boolean("shipping_is_billing")->default(false);
                $table->string("shipping_customer_name",255)->nullable(true)->default(null);
                $table->string("shipping_last_name",255)->nullable()->default(null);
                $table->string("shipping_address",255)->nullable()->default(null);
                $table->string("shipping_address_2",255)->nullable()->default(null);
                $table->string("billing_isd_code",10)->nullable()->default(null);
                $table->string("shipping_city",35)->nullable()->default(null);
                $table->integer("shipping_pincode")->nullable()->default(null);
                $table->string("shipping_state",50)->nullable()->default(null);
                $table->string("shipping_country",50)->nullable()->default(null);
                $table->string("shipping_email",255)->nullable()->default(null);
                $table->string("shipping_phone",20)->nullable()->default(null);
                $table->string("longitude",20)->nullable(true)->default(null);
                $table->string("latitude",20)->nullable(true)->default(null);
                $table->text("order_items")->nullable(false);
                $table->string("payment_method",20)->nullable(false);
                $table->string("shipping_charges",10)->nullable(true)->default(null);
                $table->string("giftwrap_charges",10)->nullable(true)->default(null);
                $table->string("total_discount",10)->nullable(true)->default(null);
                $table->string("sub_total",10)->nullable(true)->default(null);
                $table->string("length",10)->nullable(true)->default(null);
                $table->string("breadth",10)->nullable(true)->default(null);
                $table->string("height",10)->nullable(true)->default(null);
                $table->string("weight",10)->nullable(true)->default(null);
                $table->string("shipping_order_id",50)->index("shippingorder_id_srm")->nullable(true)->default(null);
                $table->string("shipment_id",50)->index("shipping_id_srm")->nullable(true)->default(null);
                $table->text("ship_rocket_response")->nullable(true)->default(null);
                $table->string("order_status",50)->nullable()->default(null);
                $table->integer("created_by")->nullable()->default(null);
                $table->integer("updated_by")->nullable()->default(null);
                //
                $table->timestamps();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('ship_rocket_management');
    }
};
