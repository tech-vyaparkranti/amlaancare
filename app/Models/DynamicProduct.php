<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicProduct extends Model
{
    protected $table = 'dynamic.products'; // Set the table name if it's not 'products'

    protected $fillable = [
        'name', 'image_url', 'price', 'serial.no', 'status', 'is_new',
    ];
}