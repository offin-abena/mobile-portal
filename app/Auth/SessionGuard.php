<?php
// app/Auth/SessionGuard.php
namespace App\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Session;
use App\Models\ApiUser;

class SessionGuard implements Guard
{
    protected $user;

    public function check()
    {
        return $this->user() !== null;
    }

    public function guest()
    {
        return !$this->check();
    }

    public function user()
    {
        if ($this->user) {
            return $this->user;
        }

        $data = Session::get('user');
        if ($data) {
            $user = new ApiUser(); // your non-db user
            foreach ($data as $key => $value) {
                $user->{$key} = $value;
            }
            return $this->user = $user;
        }

        return null;
    }

    public function id()
    {
        return $this->user() ? $this->user()->getAuthIdentifier() : null;
    }

    public function validate(array $credentials = [])
    {
        // you can add API auth here if needed
        return false;
    }

    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
        Session::put('user', [
            'id' => $user->id,
            'fullName' => $user->fullName,
            'username' => $user->username,
            'userType' => $user->userType,
            'status' => $user->status,
            'phoneNum' => $user->phoneNum,
            'email' => $user->email,
        ]);
        return $this;
    }

     public function login(Authenticatable $user, $remember = false)
    {
        $this->setUser($user);
    }

     public function hasUser()
    {
        return ! is_null($this->user);
    }

     public function logout()
    {
        Session::forget('user');
        $this->user = null;
    }
}

