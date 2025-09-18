<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;

class ForgotPasswordController extends Controller
{
    use LogsHttpErrors;
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public function ResetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ]);

        $auth_base_url = config('tgl.auth_base_url');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("$auth_base_url/admin/resetPassword",$request->only('username'));

        if ($response->successful()) {
            $resp = $response->json();

            return redirect()->route('login')->with('success', 'A new password should be sent to your phone.');
        } else {
            $this->logHttpError('Password reset failed:', $response);

            return redirect()->back()->with('error', 'Password reset failed. Please try again.');
        }
    }
}
