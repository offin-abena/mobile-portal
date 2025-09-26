<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    public $timestamps = false; // 🔥 disable Laravel auto timestamps

    protected $table = "currencyexchange_tbl";

    protected $fillable = [
        'convertFrom',
        'convertTo',
        'conversionRate',
        'dateTime',
        'updated_by',
        'updated_date',
    ];
}
