<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'return_status', 
        'return_reason', 
        'pickup_address', 
        'video_proof',  
    ];

    /**
     * Get the order that owns the return.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
