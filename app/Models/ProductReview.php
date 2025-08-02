<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $table = "product_reviews" ;

    protected $fillable = [
        'product_id' ,
        "user_id" ,
        "vendor_id",
        "review",
        "rating",
        "status",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productReviewGalleries()
    {
        return $this->hasMany(ProductReviewGallery::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
