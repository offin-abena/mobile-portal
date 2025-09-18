<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TsaTmTransaction extends Model
{
    use HasFactory;

    //protected $table = 'tsa_tm_transactions'; // make sure it matches your migration

    protected $fillable = [
        'reference_code',
        'vendor_id',
        'transaction_id',
        'current_otp',
        'hashed_current_otp',
        'amount',
        'fulfilment_status',
        'collection_status',
        'collection_mobile_no',
    ];
    // If you want automatic timestamps (created_at, updated_at)
    public $timestamps = true;
}
