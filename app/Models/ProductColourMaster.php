<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColourMaster extends Model
{
    use HasFactory;

    protected $table = "product_colour_master";

    const ID = "id";
    const COLOUR_NAME = "colour_name";
    const COLOUR_SAMPLE_IMAGE = "colour_sample_image";
    const TYPE = "type";
    const STATUS = "status";
    const CREATED_BY = "created_by";
    const UPDATED_BY = "updated_by";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    const IMAGE_TYPES = [
        "texture_color"=>"Texture Colour Image",
        "zip_color"=>"Zip Colour Image",
    ];
}
