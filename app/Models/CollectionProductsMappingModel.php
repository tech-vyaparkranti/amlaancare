<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionProductsMappingModel extends Model
{
    use HasFactory;

    protected $table = "collection_products_mapping";

    const TABLE_NAME = "collection_products_mapping";
    const ID_ALIAS = "collection_products_mapping.id";
    const PRODUCT_ALIAS = "collection_products_mapping.product_id";
    const PRODUCT_COLLECTION_ID_ALIAS = "collection_products_mapping.product_collection_id";
    const STATUS_ALIAS = "collection_products_mapping.status";
    const ID = "id";
    const PRODUCT_ID = "product_id";
    const PRODUCT_COLLECTION_ID = "product_collection_id";
    const STATUS = "status";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";


    public function products(){
        return $this->hasOne(Product::class,Product::ID,self::PRODUCT_ID)->where('status',1);
    }

    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

}
