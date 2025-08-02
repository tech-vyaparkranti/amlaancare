<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCollectionMasterModel extends Model
{
    protected $table = "product_collection_master";
    use HasFactory;

    

    const ID = "id";
    const COLLECTION_NAME = "collection_name";
    const COLLECTION_IMAGE = "collection_image";
    const SORT_NUMBER = "sort_number";
    const STATUS = "status";
    const TEXT = "text";
    const CREATED_BY = "created_by";
    const UPDATED_BY = "updated_by";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";


    public function collectionProducts(){
        return $this->hasManyThrough(Product::class,CollectionProductsMappingModel::class,
        CollectionProductsMappingModel::PRODUCT_COLLECTION_ID,
        Product::ID,
        ProductCollectionMasterModel::ID,
        CollectionProductsMappingModel::PRODUCT_ID)->where('collection_products_mapping.status',1)
        ->where('collection_products_mapping.status',1);
    }

    public function products()
{
    return $this->hasMany(CollectionProductsMappingModel::class, 'product_collection_id');
}
    
    
}
