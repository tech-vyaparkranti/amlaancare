<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorRegistrationForm extends Model
{
    use HasFactory;
    protected $table = 'vendor_registrations';
    protected $fillable = [
        'full_name', 'business_name', 'mobile_number', 'email', 'gstin',
        'street_address', 'city', 'state', 'postal_code', 'country',
        'bank_account_name', 'bank_account_number', 'ifsc_code',
        'bank_name', 'branch_name', 'cancelled_cheque', 'gst_certificate',
         'password', 'whatsapp_consent','status',
    ];
}
