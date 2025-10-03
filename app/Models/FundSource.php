<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundSource extends Model
{
   use  HasFactory;
   protected $table = 'fund_sources';

    protected $fillable = [
        'user_id',
        'provider_id',
        'momo_number',
        'momo_name',
        'status',
        'source_type',
    ];
}
