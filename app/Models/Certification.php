<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Certification extends Model
{
    use HasFactory;
    // Define the table name
    protected $table = 'certifications';

    // Define the fillable fields (these are the fields we can insert or update)
    protected $fillable = [
        'image',
        'status',
        'serial',
    ];
}

