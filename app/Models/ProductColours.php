<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColours extends Model
{
    use HasFactory;

    protected $table = "product_colours";
    const ID = "id";
    const COLOUR_MASTER_ID = "colour_master_id";
    const PRODUCT_ID = "product_id";
    const STATUS = "status";
    const CREATED_BY = "created_by";
    const UPDATED_BY = "updated_by";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    
}
