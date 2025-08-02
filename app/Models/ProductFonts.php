<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFonts extends Model
{
    use HasFactory;

    protected $table = "product_font";

    const ID = "id";
    const PRODUCT_ID = "product_id";
    const FONT_ID = "font_id";
    const STATUS = "status";
    const CREATED_BY = "created_by";
    const UPDATED_BY = "updated_by";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
