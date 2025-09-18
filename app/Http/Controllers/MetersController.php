<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;


class MetersController extends Controller
{
    use LogsHttpErrors;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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

    public function find(Request $request)
    {
        $payload=[];

        if ($request->isMethod('post')) {

                $request->validate([
                        'transaction_id' => 'required',
                        'category' => 'required|in:prepaid,postpaid',
                ]);
                $ecollect_base_url=config('tgl.ecollect_base_url');
                $ecollect_polymorph_phone_number=config('tgl.ecollect_polymorph_phone_number');


                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($url="$ecollect_base_url/SUBSPolymorphGetMeterInfo", $data= ['MeterNumber'=>$request['transaction_id'],'MeterCategory'=>$request['category']] + ['PhoneNumber' => $ecollect_polymorph_phone_number]);


                if($response->successful()){
                    $payload=$response->json();

                    if($payload['StatusCode']!='0001'){
                        return redirect()->back()->with('warning', $payload['Message']);
                    }
                }else{
                    $this->logHttpError('Login failed:', $response);

                    //return back()->withErrors($validator)->withInput();

                    return redirect()->back()->with('warning', 'Meter details not found!');
                }
        }

       return view('find-meter', compact('payload'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(Request $request)
    {
         $payload=[];
         if ($request->isMethod('post')) {

               $request->validate([
                'transaction_id' => 'required'
            ]);

            $auth_base_url=config('tgl.auth_base_url');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("$auth_base_url/transaction/manual-remove-meter", $request->only('transaction_id'));

            if($response->successful()){
                        $payload=$response->json();

                        if($payload['StatusCode']!='0001'){
                            return redirect()->back()->with('warning', $payload['Message']);
                        }
                    }else{
                        $this->logHttpError('Login failed:', $response);

                        //return back()->withErrors($validator)->withInput();

                        return redirect()->back()->with('warning', 'Meter details not found!');
            }
        }
       return view('reset-meter-profile',[$request,$payload]);

    }


}
