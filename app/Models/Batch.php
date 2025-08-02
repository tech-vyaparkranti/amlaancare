<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    protected $table = 'batches';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'batch_number';

    // If you want to disable automatic timestamps (created_at, updated_at)
    public $timestamps = false;

    // Define the properties that can be mass-assigned
    protected $fillable = [
        'batch_number',
        'batch_name',
        'start_date',
        'pdf_url',
    ];

    // Optionally, define the type of the 'start_date' field if it's a date type in your database
    protected $dates = [
        'start_date',
    ];
}
