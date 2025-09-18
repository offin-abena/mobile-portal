<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Notifications\Notifiable;

class ApiUser implements  Authenticatable
{
    public $id ;
    public $fullName ;
    public $username ;
    public $userType ;
    public $userPIN ;
    public $adminID ;
    public $userCountry ;
    public $status ;
    public $phoneNum ;
    public $email ;

    public function __construct(array $attributes = [])
    {

        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }

     public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthPassword()
    {
        return null;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        // not needed for stateless users
    }

    public function getRememberTokenName()
    {
        return null;
    }

    public function getAuthPasswordName()
    {
        return null;
    }

}
