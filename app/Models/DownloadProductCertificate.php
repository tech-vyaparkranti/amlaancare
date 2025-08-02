<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadProductCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'product_name',
        'vendor_id',
        'certificate_url',
    ];
}
