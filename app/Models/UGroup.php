<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UGroup extends Eloquent
{
    use HasFactory;

    protected $table = 'ugroup_tbl';

    protected $fillable = [
        'groupName',
        'added_by',
        'dateTime',
   ];

}
