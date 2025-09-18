<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PricingPolicy extends Eloquent
{
    use HasFactory;

    protected $table = 'pricing_policy_tbl';

    protected $fillable = [
        'senderUGroup',
        'senderAccountType',
        'recipientUGroup',
        'recipientAccountType',
        'serviceType',
        'price_in_percent_absolute',
        'priceType',
        'pricing_by',
        'pricing_date',
        'senderCountry',
        'recipientCountry',
        'sysCommission',
        'senderCommission',
        'recipientCommission',
   ];

}
