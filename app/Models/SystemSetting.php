<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SystemSetting extends Model
{
    use HasFactory;

    //public $timestamps = false; // 🔥 disable Laravel auto timestamps

    protected $table = "system_settings";

    protected $fillable = [
        'min_login_attempts',
        'password_duration',
        'allow_mobile_access',
        'allow_ussd_access',
        'allow_brassica_access',
        'allow_b_bus_access',
        'allow_bank_transfer_access',
        'allow_airtime_purchase_access',
        'allow_momo_transfer_access',
        'allow_legacy_quote_access',
    ];

}
