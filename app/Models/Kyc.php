<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kyc extends Model
{
    use HasFactory;

    public $timestamps = false; // 🔥 disable Laravel auto timestamps

    protected $table = "kyc_tbl";

    protected $fillable = [
        'countryCode',
        'name',
        'dailyAmount',
        'monthlyAmount',
        'balance',
        'transaction_limit',
    ];
}
