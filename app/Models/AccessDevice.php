<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessDevice extends Model
{
    use HasFactory;

    protected $table = 'access_devices';

    protected $fillable = [
        'userID',
        'activity',
        'action',
        'dateTime',
    ];

    protected $casts = [
        'dateTime' => 'datetime',
    ];
}
