<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFreeSetting extends Model
{
    use HasFactory;

    protected $table = "cash_free_setting";

    const ID = "id";
    const MODE = "mode";
    const STATUS    = "status";
    const COUNTRY_NAME = "country_name";
    const CURRENCY_NAME = "currency_name";
    const CURRENCY_RATE = "currency_rate";
    const CASH_FREE_CLIENT_ID = "cash_free_client_id";
    const CASH_FREE_SECRET_KEY = "cash_free_secret_key";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    protected $fillable = [
        'status',
        'mode',
        'country_name',
        'currency_name',
        'currency_rate',
        'cash_free_client_id',
        'cash_free_secret_key'
    ];
}
