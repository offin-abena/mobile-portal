<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CapitalSettlement extends Model
{
    use HasFactory;

    protected $table = "capital_settlements";

    protected $fillable = [
        'bank_name',
        'account_number',
        'amount',
        'authorization_code',
        'user',
    ];
}
