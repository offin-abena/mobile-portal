<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "customer_tbl";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'middleName',
        'surname',
        'fullName',
        'alternativeEmail',
        'email',
        'emailVerified',
        'password',
        'gender',
        'dob',
        'birthCity',
        'birthCountry',
        'nationality',
        'countryCode',
        'addressLine1',
        'addressLine2',
        'city',
        'postcode',
        'region',
        'countryResidence',
        'phoneNum',
        'phoneNumVerified',
        'homeNumber',
        'occupation',
        'companyName',
        'companyRegNumber',
        'companyRegDate',
        'idType',
        'idNumber',
        'idIssueDate',
        'idExpireDate',
        'idFile',
        'addressDocType',
        'addressDocIssueDate',
        'addressDocExpireDate',
        'addressFile',
        'proofFundDocType',
        'proofFundDocIssueDate',
        'proofFundDocExpireDate',
        'proofFundFile',
        'next_of_kin',
        'next_of_kin_phoneNum',
        'last_login_date',
        'status',
        'keyCode',
        'accountType',
        'accountKYC',
        'email_token',
        'token_expiration',
        'token_validated',
        'registeredPhoneType',
        'currencyType',
        'ussdPasscode',
        'physical_address',
        'uGroup',
];

    protected $primaryKey = "id";

    public $incrementing = false;

    protected $keyType = 'string';



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'uuid', 'id');
    }

    public function customer_account(): HasOne
    {
        return $this->hasOne(CustomerAccount::class, 'customerID', 'id');
    }


    public function account_type(): BelongsTo
    {
        return $this->belongsTo(AccountType::class, 'accountType', 'id');
    }
}
