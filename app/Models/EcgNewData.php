<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcgNewData extends Model
{
    use HasFactory;

    protected $table = 'ecg_new_data';

    protected $fillable = [
        'district',
        'meteringSystem',
        'phoneNumber',
        'region',
        'regionId',
        'districtId',
        'CMSID',
        'vendorId',
        'vendorName',
        'vendorStatus',
    ];

    // protected $casts = [
    //     'dateTime' => 'datetime',
    // ];
}
