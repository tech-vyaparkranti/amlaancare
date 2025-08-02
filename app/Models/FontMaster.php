<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FontMaster extends Model
{
    use HasFactory;

    protected $table = "font_master";

    const ID = "id";
    const FONT_NAME = "font_name";
    const FONT_SAMPLE_IMAGE = "font_sample_image";
    const STATUS = "status";
    const CREATED_BY = "created_by";
    const UPDATED_BY = "updated_by";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
