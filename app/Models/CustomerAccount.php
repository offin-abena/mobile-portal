<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model
{
    use HasFactory;

    protected $table = "customeraccount_tbl";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        "balance",
        "customerID",
        "remark",
        "credit",
        "debit",
        "idStatus",
        "commissionAccount",
        "countryCode",
        "created_at",
        "updated_at",
    ];

    protected $primaryKey = "id";

    public $incrementing = false;

    protected $keyType = 'string';
}
