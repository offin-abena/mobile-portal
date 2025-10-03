<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProviderService extends Model
{
    use HasFactory;

    //public $timestamps = false;

    protected $table = "providers_services";

    protected $fillable = [
        'name',
        'routing_number',
        'country_id',
        'country_name',
        'instructions',
        'logo',
        'category',
        'channel',
        'status',
    ];
}
