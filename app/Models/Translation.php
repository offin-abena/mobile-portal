<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'feature',
        'platform',
        'keyz',
        'textz',
        'english',
        'french',
        'pidgin',
        'swahili',
        'spanish',
        'arabic',
    ];
}
