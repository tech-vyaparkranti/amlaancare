<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const TABLE_NAME = "products";
    const ID_ALIAS = "products.id";
    const STATUS_ALIAS = "products.status";
    const NAME_ALIAS = "products.name";
    const ID = "id";
    const NAME = "name";
    const SLUG = "slug";
    const THUMB_IMAGE = "thumb_image";
    const VENDOR_ID = "vendor_id";
    const CATEGORY_ID = "category_id";
    const SUB_CATEGORY_ID = "sub_category_id";
    const CHILD_CATEGORY_ID = "child_category_id";
    const BRAND_ID = "brand_id";
    const QTY = "qty";
    const SHORT_DESCRIPTION = "short_description";
    const LONG_DESCRIPTION = "long_description";
    const VIDEO_LINK = "video_link";
    const SKU = "sku";
    const PRICE = "price";
    const OFFER_PRICE = "offer_price";
    const OFFER_START_DATE = "offer_start_date";
    const OFFER_END_DATE = "offer_end_date";
    const PRODUCT_TYPE = "product_type";
    const TAKE_INSIDE_TEXT = "take_inside_text";
    const INSIDE_TEXT_PRICE = "inside_text_price";
    const GIFT_WRAP_OPTION = "gift_wrap_option";
    const GIFT_WRAP_OPTION_PRICE = "gift_wrap_option_price";
    const RUSH_SERVICE = "rush_service";
    const RUSH_SERVICE_PRICE = "rush_service_price";
    const CUSTOM_DESIGN_OPTION = "custom_design_option";
    const CUSTOM_DESIGN_OPTION_PRICE = "custom_design_option_price";
    const SPECIAL_INSTRUCTIONS = "special_instructions";
    const STATUS = "status";
    const IS_APPROVED = "is_approved";
    const SEO_TITLE = "seo_title";
    const SEO_DESCRIPTION = "seo_description";
    const TAKE_NAME = "take_name";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    const INSIDE_TEXT_TYPES = [
        "text" => "Text",
        "date" => "Date",
        'handwriting' => "Handwriting"
    ];

    // New attributes added by migration
    const LENGTH = 'length';
    const BREADTH = 'breadth';
    const HEIGHT = 'height';
    const WEIGHT = 'weight';
    const HSN_CODE = 'hsn_code';
    const PRODUCT_CERTIFICATE = 'product_certificate';

    // Relationships (No relationship for product_certificate, just an attribute)
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImageGalleries()
    {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function productColours()
    {
        return $this->belongsToMany(ProductColourMaster::class, "product_colours", "product_id", "colour_master_id")
            ->where("product_colours.status", 1);
    }

    public function productFonts()
    {
        return $this->belongsToMany(FontMaster::class, "product_font", "product_id", "font_id")
            ->where("product_font.status", 1);
    }

    public function productInsideText()
    {
        return $this->hasMany(ProductInsideTexts::class, "product_id", "id")
            ->where("status", 1);
    }

    // Accessor and mutators (Optional)
    public function getLengthAttribute($value)
    {
        return $value ? (float)$value : null;
    }

    public function getBreadthAttribute($value)
    {
        return $value ? (float)$value : null;
    }

    public function getHeightAttribute($value)
    {
        return $value ? (float)$value : null;
    }

    public function getWeightAttribute($value)
    {
        return $value ? (float)$value : null;
    }

    public function getHsnCodeAttribute($value)
    {
        return $value ? $value : null;
    }
}
