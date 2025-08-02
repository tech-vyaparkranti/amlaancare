<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HomePageDetail extends Model
{
    use HasFactory;

    protected $table = "home_page_details"; // Ensure this matches your table name

    // Define constants for column names
    const ID = "id";
    const ABOUT_US_IMAGES = "about_us_images";
    const ABOUT_US_SHORT_DESC = "about_us_short_description";
    const FOUNDER_NAME = "founder_name";
    const FOUNDER_IMAGE = "founder_image";
    const MESSAGE = "message_from_founder";
    const STATUS = "status";
    const CREATED_BY = "created_by";
    const UPDATED_BY = "updated_by";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    const STATUS_ALIAS = "home_page_details.status";
    const ID_ALIAS = "home_page_details.id";

    // New constants for video columns
    const DESKTOP_VIDEO = "desktop_video";
    const MOBILE_VIDEO = "mobile_video";

    // Defining which fields can be mass-assigned
    protected $fillable = [
        self::ABOUT_US_IMAGES,
        self::ABOUT_US_SHORT_DESC,
        self::FOUNDER_NAME,
        self::FOUNDER_IMAGE,
        self::MESSAGE,
        self::STATUS,
        self::CREATED_BY,
        self::UPDATED_BY,
        self::DESKTOP_VIDEO,  // Add desktop_video to fillable
        self::MOBILE_VIDEO,   // Add mobile_video to fillable
    ];

    // If you want to handle casting JSON fields as arrays (useful for images or other arrays)
    protected $casts = [
        self::ABOUT_US_IMAGES => 'array', // Automatically decode the JSON array when retrieved
        // No need for casting on desktop_video and mobile_video since they are just strings/URLs
    ];

    // Boot method to automatically generate slugs before saving (if needed)
    // You can add logic here if you want to auto-generate a slug field based on some column.
}
