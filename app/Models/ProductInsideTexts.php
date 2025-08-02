<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInsideTexts extends Model
{
    use HasFactory;

    protected $table = "product_inside_texts";

    const ID = "id";
    const TEXT_TYPE = "text_type";
    const PRODUCT_ID = "product_id";
    const STATUS = "status";
    const CREATED_BY = "created_by";
    const UPDATED_BY = "updated_by";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
