<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferrersController extends Controller
{
    public function index(Request $request){
       return view('referrer');
    }
}
