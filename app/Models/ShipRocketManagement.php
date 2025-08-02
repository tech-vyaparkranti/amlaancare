<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipRocketManagement extends Model
{
    use HasFactory;

    protected $table = "ship_rocket_management";

    const ID = "id";
    const ORDER_ID = "order_id";
    const ORDER_DATE = "order_date";
    const PICKUP_LOCATION = "pickup_location";
    const RESELLER_NAME = "reseller_name";
    const COMPANY_NAME = "company_name";
    const CHANNEL_ID = "channel_id";
    const BILLING_CUSTOMER_NAME = "billing_customer_name";
    const BILLING_LAST_NAME = "billing_last_name";
    const BILLING_ADDRESS = "billing_address";
    const BILLING_ADDRESS_2 = "billing_address_2";
    const BILLING_CITY = "billing_city";
    const BILLING_PINCODE = "billing_pincode";
    const BILLING_STATE = "billing_state";
    const BILLING_COUNTRY = "billing_country";
    const BILLING_EMAIL = "billing_email";
    const BILLING_PHONE = "billing_phone";
    const BILLING_ALTERNATE_PHONE = "billing_alternate_phone";
    const SHIPPING_IS_BILLING = "shipping_is_billing";
    const SHIPPING_CUSTOMER_NAME = "shipping_customer_name";
    const SHIPPING_LAST_NAME = "shipping_last_name";
    const SHIPPING_ADDRESS = "shipping_address";
    const SHIPPING_ADDRESS_2 = "shipping_address_2";
    const BILLING_ISD_CODE = "billing_isd_code";
    const SHIPPING_CITY = "shipping_city";
    const SHIPPING_PINCODE = "shipping_pincode";
    const SHIPPING_STATE = "shipping_state";
    const SHIPPING_COUNTRY = "shipping_country";
    const SHIPPING_EMAIL = "shipping_email";
    const SHIPPING_PHONE = "shipping_phone";
    const LONGITUDE = "longitude";
    const LATITUDE = "latitude";
    const ORDER_ITEMS = "order_items";
    const PAYMENT_METHOD = "payment_method";
    const SHIPPING_CHARGES = "shipping_charges";
    const GIFTWRAP_CHARGES = "giftwrap_charges";
    const TOTAL_DISCOUNT = "total_discount";
    const SUB_TOTAL = "sub_total";
    const LENGTH = "length";
    const BREADTH = "breadth";
    const HEIGHT = "height";
    const WEIGHT = "weight";
    const SHIPPING_ORDER_ID = "shipping_order_id";
    const SHIPMENT_ID = "shipment_id";
    const ORDER_STATUS = "order_status";
    const CREATED_BY = "created_by";
    const UPDATED_BY = "updated_by";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    const SHIP_ROCKET_RESPONSE = "ship_rocket_response";
    const RETURN_STATUS = "return_status";
    const RETURN_REASON = "return_reason";
    const RETURN_RESPONSE = "return_response";
}
