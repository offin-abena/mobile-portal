<?php

namespace App\Http\Controllers;
use App\Models\UGroup;
use App\Models\AccountType;

use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function servicePrincing()
    {
        return view('service-pricing');
    }

    public function main()
    {
        $groups=UGroup::orderBy('groupName')->get();
        $accountTypes=AccountType::orderBy('accountType')->get();

        return view('main-pricing',compact('groups','accountTypes'));
    }
}
