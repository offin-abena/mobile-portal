<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintransaction extends Model
{
    use HasFactory;

    protected $table = "maintransaction_tbl";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        "created_at",
        "updated_at",
        "transactionTypes",
        "transaction_uid",
        "link_reference",
        "transactionStatus",
        "senderCountryCode",
        "recipientCountryCode",
        "senderID",
        "recipientID",
        "sendersAmount",
        "recipientAmount",
        "senderBalance",
        "recipientBalance",
        "fee",
        "exRate",
        "pricing_id",
        "deviceType",
        "completedDate",
        "foreignId",
		"comment",
		"refund_provider_id",
        "airtimeNumber",
        "airtimeChannel",
        "w_customerID",
        "w_sender_name",
        "w_idType",
        "w_idNumber",
        "w_idIssuedDate",
        "w_idExpDate",
        "w_email" ,
        "w_phoneNumber",
        'remitRecipientName',
        'remitRecipientMomoName',
        'remitRecipientMomoNumber',
        'remitRecipientChannel',
        'remitRecipientBankName',
        'remitRecipientBankAccount',
        'remitRecipientBankAccountName',
		'rechargeToken',
		'externalTransactionId',
		'rechargeMode',
		'statusDescription',
        'bundlePackage',
		'auto_reverse_status',
        'bill_type',
        'billCode',
		'async_id',
		'receipt',
		'app_version',
		'sdk_version',
		'provider_id',
		'fund_source_id',
		'write_status',
        'purpose'
    ];


    protected $primaryKey = "id";

    public $incrementing = false;

    protected $keyType = 'string';


}
