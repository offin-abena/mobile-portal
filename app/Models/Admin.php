<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'username',
        'password',
        'userType',
        'userPIN',
        'adminID',
        'userCountry',
        'status',
        'phoneNum',
        'email',
    ];

    protected $hidden = [
        'password',
        'userPIN',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($admin) {
            // Auto-generate adminID if not set
           \Log::info("Creating Admin: " . json_encode($admin));
        });
    }
}

