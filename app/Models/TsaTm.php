<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TsaTm extends Eloquent
{
    use HasFactory;

    protected $table = 'tsa_tm_database';

    protected $fillable = [
        'phone_num',
        'reference_code',
        'full_name',
        'status',
        'current_otp',
        'hashed_current_otp',
        'password',
        'amount_limit',
   ];

}
