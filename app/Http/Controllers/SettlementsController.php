<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;
use App\Models\CapitalSettlement;

class SettlementsController extends Controller
{
    use LogsHttpErrors;
    /**
     * Display a listing of the resource.
     */
    public function capital(Request $request)
    {
        $payload=[];
        if ($request->isMethod('post')) {

                $validated=$request->validate([
                        'account_no' => 'required',
                        'amount' => 'required|numeric',
                        'code'=>'required'
                ]);

                if($validated['code']!=config('tgl.settlement_code')){
                     return redirect()->back()->with('warning', 'Invalid settlement code');
                }

                $auth_base_url=config('tgl.auth_base_url');
                $routing_no=config('tgl.settlement_routing_number');
	            $account_name=config('tgl.settlement_account_name');

	            $user_name=config('tgl.settlement_username');
	            $user_password=config('tgl.settlement_password');


                $transaction_id = str_pad(mt_rand(0, 99999999999999), 8, '0', STR_PAD_LEFT).date("ydm");

                $response = Http::withBasicAuth($user_name,$user_password)->withHeaders([
                    'Content-Type' => 'application/json'
                ])->post($url="$auth_base_url/transaction/credit-custodian-account", [
                    'routing_number' => $routing_no,
                    'account_no' => $validated['account_no'],
                    'amount' => $validated['amount'],
                    'account_name' => $account_name,
                    'transaction_id' => $transaction_id
                ]);

                if($response->successful()){

                    $payload=$response->json();

                    $message = $payload['message']." >>>>>>>>>>>>>> ".$payload['status'];

                    if($payload['statusCode']!='202'){
                        return redirect()->back()->with('warning', $message);
                    }

                    session()->flash('success', 'Settlement successful!');

                    //Log the settlemnt into the capital settlement table
                    CapitalSettlement::create([
                        'bank_name'=>$account_name,
                        'account_number'=>$validated['account_no'],
                        'amount'=>$validated['amount'],
                        'authorization_code'=>$validated['code'],
                        'user'=>auth()->user()->fullName,
                        'user_phone'=>auth()->user()->phoneNum
                    ]);
                }
                else{
                    $this->logHttpError('Settlement failed:', $response);

                    $payload=$response->json();

                    $message = null;

                    if(isset($payload['message']) && isset($payload['status'])){
                      $message = $payload['message']." >>>>>>>>>>>>>> ".$payload['status'];
                    }

                    return redirect()->back()->with('warning', isset($message) ? $message :'Settlement failed!');
                }
        }
        return view('settle-capital',compact('payload'));
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
