<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Eloquent
{
    use HasFactory;

    protected $table = 'services_tbl';

    protected $fillable = [
        'general_service',
        'serviceName',
        'senderCountry',
        'recipientCountry',
        'minimum',
        'maximum',
        'added_by',
        'dateTime',
   ];

}
