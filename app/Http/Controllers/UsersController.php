<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;

class UsersController extends Controller
{
    use LogsHttpErrors;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $payload=[];
        if ($request->isMethod('post')) {

                $request->validate([
                        'fullName' => 'required',
                        'username' => 'required',
                        'pin' => 'required|digits:4',
                        'phoneNum' => 'required|numeric|min:10',
                        'password' => 'required|string|min:8|confirmed',
                        'emailadd' => 'required|email',
                        'role' => 'required|in:SYSTEMADMIN,ADMINISTRATOR,VMANAGER,FRONTDESK,ACCOUNTANT,COMPLIANCE',
                        'status' => 'required',
                        //'country' => 'required|in:gh'
                ]);

                $auth_base_url=config('tgl.auth_base_url');

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($url="$auth_base_url/admin/signup", [
                    'username'=>$request->username,
                    'fullName' => $request->fullName,
                    'userPIN' => $request->pin,
                    'status'=>$request->status,
                    'userCountry'=>$request->get('country','gh'),
                    'userType'=>$request->role,
                    'adminID'=>auth()->user()->id,
                    'phoneNum'=>$request->phoneNum,
                    'email'=>$request->emailadd,
                    'password'=>$request->password,
                ]);



                if($response->successful()){
                    $payload=$response->json();

                    if($payload['StatusCode']!='0001'){
                        return redirect()->back()->with('warning', $payload['message']);
                    }
                }
                else{
                    $this->logHttpError('Login failed:', $response);

                     $payload=$response->json();
                     //dd($payload);

                    return redirect()->back()->with('warning',$payload['message']??'User creation failed. Please try again later.');
                }
        }
        return view('users',[$payload,$request]);
    }

    public function systemAccount()
    {
        return view('system-account');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
