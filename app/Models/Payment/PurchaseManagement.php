<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseManagement extends Model
{
    use HasFactory;

    protected $table= "purchase_management";
    const ID="id";
    const ORDER_ID="order_id";
    const AMOUNT="amount";
    const CURRENCY_CODE="currency_code";
    const PAYMENT_TYPE="payment_type";//'pre_paid', 'cod', 'complementary'
    const PAYMENT_STATUS="payment_status";//'pending','inprocess','success','failed','retry'
    const USER_ID="user_id";
    const PRODUCT_IDS="product_ids";
    const PAYMENT_GATEWAY_REQUEST="payment_gateway_request";
    const PAYMENT_GATEWAY_RESPONSE="payment_gateway_response";
    const PAYMENT_GATEWAY_ID="payment_gateway_id";
    const PAYMENT_GATEWAY="payment_gateway";
    const PURCHASE_START_DATE_TIME="purchase_start_date_time";
    const PURCHASE_COMPLETION_DATE_TIME="purchase_completion_date_time";
    const CREATED_AT="created_at";
    const UPDATED_AT="updated_at";

    const PAYMENT_TYPES = ['pre_paid', 'cod', 'complementary'];
    const PAYMENT_STATUSES = ['pending','inprocess','success','failed','retry'];
}
