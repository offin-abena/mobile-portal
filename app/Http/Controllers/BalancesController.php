<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;

class BalancesController extends Controller
{
    use LogsHttpErrors;
    /**
     * Display a listing of the resource.
     */
    private $ecollect_base_url;
    private $terminal_id;
    private $authorization;
    private $async_request_id;
    public function __construct()
    {
        $this->ecollect_base_url=config('tgl.ecollect_base_url');
        $this->terminal_id=config('tgl.ecollect_terminal_id');
        $this->authorization=config('tgl.ecollect_authorization');
        $this->async_request_id=config('tgl.ecollect_async_request_id');
        $this->payload=[];
    }

    public function tgl_balances(Request $request)
    {
        if ($request->isMethod('post')) {

                $request->validate([
                        'vendorId' => 'required',
                ]);

                //dd($request->all());
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    "Authorization" => $this->authorization,
                    "Referer"=>$this->terminal_id
                ])->post($url="$this->ecollect_base_url/GetMerchantQuota", $data= ['asyncRequestId'=>$this->async_request_id,'merchantId'=>$request['vendorId'],'terminalId'=>$this->terminal_id]);

                if($response->successful()){
                    $payload=$response->json();

                    if(isset($payload['status']) && $payload['status']['code']=='-1'){
                        return redirect()->back()->with('warning', $payload['status']['message']);
                    }
                    $this->payload['balance']=$payload;
                }else{
                    $this->logHttpError('TGL Balance failed:', $response);

                    return redirect()->back()->with('warning', 'TGL Balance retrival failed!');
                }


                $response = $this->get_tgl_vendor_commission($request);

                if($response->successful()){
                            $payload=$response->json();

                            if($payload['statusCode']!='0001'){
                                return redirect()->back()->with('warning', $payload['message']);
                            }

                            $this->payload['commission']=$payload;
                }else{
                            $this->logHttpError('TGL Vendor Commission failed:', $response);

                            return redirect()->back()->with('warning', 'TGL Vendor Commission retrival failed!');
                }
        }

        return view('tgl-balances',['payload'=>$this->payload,'request'=>$request]);
    }

    private function get_tgl_vendor_commission(Request $request)
    {

            $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    "Authorization" => $this->authorization,
                    "Referer"=>$this->terminal_id
                ])->post($url=$this->ecollect_base_url."/GetMerchantQuota", $data= ['asyncRequestId'=>$this->async_request_id,'merchantId'=>$request['vendorId'],'terminalId'=>$this->terminal_id]);


                return $response;
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
