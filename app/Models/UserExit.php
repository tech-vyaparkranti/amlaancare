<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  // For logged-in users
        'url',      // The URL of the page exited
        'timestamp', // The timestamp when the exit occurred
    ];
}
