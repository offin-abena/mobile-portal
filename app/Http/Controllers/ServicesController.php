<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $payload=[];
        if ($request->isMethod('post')) {

                $validated=$request->validate([
                        'senderGroup'          => 'required|integer',
                        'recipientGroup'       => 'required|integer',
                        'sendersAccountType'   => 'required|integer',
                        'recipientAccountType' => 'required|integer',
                        'serviceType'          => 'required|integer',
                        'priceType'            => 'required|in:ABSOLUTE,PERCENTAGE',
                        'price'                => 'required|numeric|min:0',
                        'senderCountry'        => 'required|string|max:5',
                        'recipientCountry'     => 'required|string|max:5',
                        'sysCommission'        => 'required|numeric|min:0',
                        'senderCommission'     => 'required|numeric|min:0',
                        'recipientCommission'  => 'required|numeric|min:0',
                ]);

                $create_pricing_endpoint=route('api.prices.create');

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($url="$create_pricing_endpoint", $validated);

                if($response->successful()){
                    $payload=$response->json();

                    if($payload['statusCode']!='200'){
                        return redirect()->back()->with('warning', $payload['Message']);
                    }

                    session()->flash('success', 'Pricing saved successful!');

                }else{
                    $this->logHttpError('Login failed:', $response);

                    return redirect()->back()->with('warning', $response->json('message') ?? 'Pricing creation failed!');
                }
        }
        return view('service-pricing');
    }
}
