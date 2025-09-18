<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountType extends Eloquent
{
    use HasFactory;

    protected $table = 'accounttype_tbl';

    protected $fillable = [
        'groupName',
        'added_by',
        'dateTime',
   ];

}
