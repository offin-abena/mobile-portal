<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;

class TSAController extends Controller
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
                'referenceCode' => 'required',
                'fullName' => 'required',
                'phoneNum' => 'required|numeric|min:10',
                'amount' => 'required|numeric|min:1',
            ]);

            $auth_base_url=config('tgl.auth_base_url');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("$auth_base_url/vendor/v1.01/register-tsa", $request->only('referenceCode','fullName','phoneNum','amount'));

            if($response->successful())
            {
                        $payload=$response->json();

                        if($payload['statusCode']!='200'){
                            return redirect()->back()->with('warning', $payload['message']);
                        }
                        session()->flash('success','TSA TM added successfully');
            }else{
                        $this->logHttpError('Add TSA TM failed:', $response);


                        return redirect()->back()->with('warning',$response->json('message') ?? 'Add TSA TM failed. Please try again later!');
            }
        }
        return view('tsa-mgt',['payload'=>$payload,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
