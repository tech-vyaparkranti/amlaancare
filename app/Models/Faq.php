<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq_data';
    protected $fillable = ['faq', 'status'];

    protected $casts = [
        'faq' => 'array', // Cast to array automatically when fetching from database
    ];
}
