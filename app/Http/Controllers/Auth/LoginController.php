<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\ApiUser;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Auth\LoginRequest;
use App\Traits\LogsHttpErrors;

class LoginController extends Controller
{
    use LogsHttpErrors;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }

    public function login(LoginRequest $request)
    {

        $auth_base_url=config('tgl.auth_base_url');

        $response = Http::withOptions(['verify' => false])->withHeaders([
            'Content-Type' => 'application/json',
        ])->post("$auth_base_url/admin/login", $request->only('username', 'password'));

        if($response->successful()){
            $resp=$response->json();

            $user=new ApiUser($resp['data']);

            Auth::guard('web')->login($user);

            return redirect()->route('home')->with('success', 'Login success!');
        }else{
            $this->logHttpError('Login failed:', $response);

            return redirect()->back()->with('warning', 'Login failed!');
        }

    }
}
