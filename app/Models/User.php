<?php

namespace App\Models;

use App\Helpers\Security;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;


    public function recoveries()
    {
        return $this->hasMany(PasswordReset::class);
    }

    public function getFullNameAttribute()
    {
        return ucwords(trim($this->first_name . ' ' . $this->middle_name) . ' ' . $this->surname);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'first_name',
        'middle_name',
        'surname',
        'region',
        'mobile_no',
        'gender',
        'pin',
        'can_pin_login',
        'can_finger_print_login',
        'can_facial_login',
        'dob',
        'ghana_post_gps',
        'id_type_id',
        'id_no',
        'id_expiry_date',
        'notification_token',
		'notification_type',
		'country_id',
        'city',
        'agreed_terms_conditions',
        'password',
        'email',
		'referral_code',
        'password',
        "signup_platform",
        "sec_mother_first_name",
        "sec_favorite_animal",
        "sec_home_town",
		"manual_repair_status",
		"amount",
		"async_id",
        "device_id",
        'last_platform',
		'last_name',
		'email',
		'onboarding_source',
        'otp_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pin'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_verified_at' => 'datetime',
        'last_login'=>'datetime',
        'id_expiry_date'=>'date',
        'dob'=>'date'
    ];

   public function setMobileNoAttribute($value){
       $value=trim($value);
       if($value && strlen(intval($value))<=9)
       $this->attributes['mobile_no']=intval($this->country->call_prefix ?? '233').intval($value);
       else
       $this->attributes['mobile_no']=$value?intval($value):null;
   }

   public function setOtpVerifiedAtAttribute($value){
        if($value)
        $this->attributes['account_verified']=true;
   }
   public function setEmailVerifiedAtAttribute($value){
        if($value)
        $this->attributes['account_verified']=true;
   }

   public function devices()
   {
       return $this->hasMany(AccessDevice::class,'user_id','id');
   }

   public function last_device()
   {
       return $this->hasOne(AccessDevice::class);
   }

   public function country()
   {
       return $this->belongsTo(Country::class);
   }

   public function id_type()
   {
       return $this->belongsTo(IdType::class);
   }

   public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
