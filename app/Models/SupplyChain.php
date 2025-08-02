<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyChain extends Model
{
    use HasFactory;

    // Define the table if it's not following Laravel's naming conventions
    // protected $table = 'your_table_name';

    // Define the fillable fields (fields you want to mass-assign)
    protected $fillable = [
        'image',
        'title',
        'content',
        'faq',
        'status',
    ];

    // Define the type of 'faq' field to be cast as an array (for easier manipulation)
    protected $casts = [
        'faq' => 'array', // Automatically casts JSON column to array when accessing it
    ];

    // You can define accessors or mutators here if you need to format data (optional)
}
