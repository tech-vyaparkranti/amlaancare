<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = "shopping_cart";

    const ID = "id";
    const PRODUCT_ID = "product_id";
    const QANTITY = "qantity";
    const PRICE = "price";
    const VARIANT_OPTIONS = "variant_options";
    const PRODUCT_INFO = "product_info";
    const SPECIAL_INSTRUCTIONS = "special_instructions";
    const STATUS = "status";
    const USER_ID = "user_id";
    const TEMP_SESSION_ID = "temp_session_id";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
