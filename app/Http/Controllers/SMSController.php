<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function quickSend()
    {
        return view('quick-sms');
    }
}
