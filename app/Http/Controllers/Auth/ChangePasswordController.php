<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;

class ChangePasswordController extends Controller
{
    use LogsHttpErrors;

    public function showChangeForm()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|confirmed',
            //'confirmNewPassword' => 'required|min:8|confirmed',
        ]);

        $auth_base_url = config('tgl.auth_base_url');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("$auth_base_url/admin/changePassword", [
            'username'     => Auth::user()->username,
            'old_password' => $request->currentPassword,
            'new_password' => $request->newPassword,
        ]);

        if ($response->successful()) {
            $resp = $response->json();


            Auth::logout();
            return redirect()->route('login')->with('success', 'Password changed successfully');
        } else {
            $this->logHttpError('Password change failed:', $response);

            return redirect()->route('home')->with('error', 'Password change failed. Please try again.');
        }
    }
}
