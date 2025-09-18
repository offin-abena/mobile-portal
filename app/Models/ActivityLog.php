<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_log';

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
