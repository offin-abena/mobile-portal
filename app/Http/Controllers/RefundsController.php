<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;


class RefundsController extends Controller
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
                'transaction_id' => 'required',
                'code' => 'required',
            ]);

            $auth_base_url=config('tgl.auth_base_url');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("$auth_base_url/transaction/payment-reversal-power", $request->only('transaction_id','code'));

            if($response->successful())
            {
                        $payload=$response->json();

                         if($payload['statusCode']=='404'){
                            return redirect()->back()->with('warning','Transaction not found');
                        }
                        else if($payload['statusCode']!='200'){
                            return redirect()->back()->with('warning', $payload['Message']);
                        }

                    session()->flash('success','Power reversal successful');
            }
            else{
                        $this->logHttpError('Power reversal failed:', $response);

                        return redirect()->back()->with('warning', 'Power reversal failed. Please try again later!');
            }
        }
        return view('refund-power',[$payload,$request]);
    }

    public function refundOthers(Request $request)
    {
        $payload=[];
        if ($request->isMethod('post')) {

            $request->validate([
                'transaction_id' => 'required',
                'code' => 'required',
            ]);

            $auth_base_url=config('tgl.auth_base_url');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("$auth_base_url/transaction/payment-reversal-others", $request->only('transaction_id','code'));

            if($response->successful())
            {
                        $payload=$response->json();

                        if($payload['statusCode']=='404'){
                            return redirect()->back()->with('warning','Transaction not found');
                        }
                        else if($payload['statusCode']!='200'){
                            return redirect()->back()->with('warning', $payload['message']);
                        }

                       session()->flash('success','Transaction reversal successful');

            }else{
                        $this->logHttpError('Transaction reversal failed:', $response);

                        return redirect()->back()->with('warning', 'Transaction reversal failed. Please try again later!');
            }
        }

        return view('refund-others',[$payload,$request]);
    }

    public function payments(Request $request)
    {
        $payload=[];
        if ($request->isMethod('post')) {

            $request->validate([
                'transaction_id' => 'required',
                'code' => 'required',
            ]);

            $auth_base_url=config('tgl.auth_base_url');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url="$auth_base_url/transaction/scheduled-reversal-pull", $request->only('transaction_id','code'));


            if($response->successful())
            {
                        $payload=$response->json();

                        if($payload['statusCode']=='404'){
                            return redirect()->back()->with('warning','Transaction not found');
                        }
                        else if($payload['statusCode']!='200'){
                            return redirect()->back()->with('warning', $payload['message']);
                        }

                        session()->flash('success','Payment refund successful');
            }else{
                        $this->logHttpError('Payment refund failed:', $response);

                        return redirect()->back()->with('warning', $response->json('message')??'Payment refund failed. Please try again later!');
            }
        }

        return view('refund-payments',[$payload,$request]);
    }

    public function refundCandidate()
    {
        return view('refund-candidate');
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
