<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Referrer extends Model
{
      use HasFactory;

    protected $fillable = [
        'fullName',
        'phone',
        'email',
        'gender',
        'region',
        'referrer_type',
        'code'
   ];
}
