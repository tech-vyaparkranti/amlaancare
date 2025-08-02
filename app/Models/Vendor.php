<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    // Define which fields are mass assignable
    protected $fillable = [
        'banner', 
        'shop_name', 
        'phone', 
        'email', 
        'address', 
        'city', 
        'state', 
        'country', 
        'pincode', 
        'pickup_location', 
        'description', 
        'user_id', 
        'status'
    ];

    /**
     * Get the user associated with the vendor.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
