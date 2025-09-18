<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;

class QuotaController extends Controller
{
    use LogsHttpErrors;
    /**
     * Display a listing of the resource.
     */
    protected $meter_data= [
                    ['meteringSystem' => 'CLOU', 'location' => 'Tema CLOU', 'regionId' => '3001', 'districtId' => '3020', 'vendorId' => 'TGLX'],
                    ['meteringSystem' => 'IMES', 'location' => 'Ashanti IMES', 'regionId' => '9001', 'districtId' => '9050', 'vendorId' => 'MH00058'],
                    ['meteringSystem' => 'ECash', 'location' => 'Tema', 'regionId' => '3001', 'districtId' => '3010', 'vendorId' => '22331-430'],
                    ['meteringSystem' => 'ECash', 'location' => 'Accra East', 'regionId' => '1001', 'districtId' => '1010', 'vendorId' => '22330-395'],
                    ['meteringSystem' => 'ECash', 'location' => 'Takoradi', 'regionId' => '7001', 'districtId' => '7080', 'vendorId' => '22669-239'],
                    ['meteringSystem' => 'ECash', 'location' => 'Kasoa', 'regionId' => '8001', 'districtId' => '8090', 'vendorId' => '22891-368'],
                    ['meteringSystem' => 'ECash', 'location' => 'Ho', 'regionId' => '4001', 'districtId' => '4040', 'vendorId' => '22331-33'],
                    ['meteringSystem' => 'ECash', 'location' => 'Cape Coast', 'regionId' => '8001', 'districtId' => '8010', 'vendorId' => '22111-107'],
                    ['meteringSystem' => 'Smart G', 'location' => 'Ashanti Smart G', 'regionId' => '6001', 'districtId' => '6050', 'vendorId' => '22331-193'],
                    ['meteringSystem' => 'Holley', 'location' => 'Ashanti Holley', 'regionId' => '9001', 'districtId' => '9010', 'vendorId' => 'TGLX'],
                    ['meteringSystem' => 'BOT', 'location' => 'Accra BOT', 'regionId' => '2001', 'districtId' => '2010', 'vendorId' => '4897'],
                    ['meteringSystem' => 'BXC', 'location' => 'Accra BXC', 'regionId' => '2001', 'districtId' => '2030', 'vendorId' => '12271'],
                    ['meteringSystem' => 'PNS', 'location' => 'Accra PNS', 'regionId' => '1001', 'districtId' => '1060', 'vendorId' => '5703'],
                    ['meteringSystem' => 'ECash', 'location' => 'Swedru', 'regionId' => '8001', 'districtId' => '8070', 'vendorId' => '22871-62'],
                    ['meteringSystem' => 'ECash', 'location' => 'Nkawkaw', 'regionId' => '5001', 'districtId' => '5110', 'vendorId' => '25111-47'],
                    ['meteringSystem' => 'ECash', 'location' => 'Tafo', 'regionId' => '5001', 'districtId' => '5030', 'vendorId' => '22531-22'],
                    ['meteringSystem' => 'ECash', 'location' => 'Winneba', 'regionId' => '8001', 'districtId' => '8080', 'vendorId' => '22531-28'],
                    ['meteringSystem' => 'ECash', 'location' => 'Hohoe', 'regionId' => '4001', 'districtId' => '4070', 'vendorId' => '22471-17'],
                    ['meteringSystem' => 'ECash', 'location' => 'Koforidua', 'regionId' => '5001', 'districtId' => '5040', 'vendorId' => '22331-138'],
                ];
    public function index(Request $request)
    {
        $payload=[];
        if ($request->isMethod('post')) {

                $validated=$request->validate([
                        'type'=>'required|in:INFO,ACTIVATE,CREDIT,BONDED-CREDIT',
                        'mobile_no' => 'required|numeric|min:10',
                        'amount' => 'required|numeric|min:1',
                        'company_code' => 'required',
                        'meter_no' => 'sometimes|nullable',
                        'account_no' => 'sometimes|nullable'
                ]);
                $merchant_base_url=config('tgl.merchant_base_url');

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($url="$merchant_base_url/transaction/credit-account-info", $validated);


                if($response->successful()){
                    $payload=$response->json();

                    if($payload['statusCode']!='200'){
                        return redirect()->back()->with('warning', $payload['Message']);
                    }

                    session()->flash('success', 'Quota credit successful!');

                }else{
                    $this->logHttpError('Login failed:', $response);

                    return redirect()->back()->with('warning', $response->json('message') ?? 'Quota credit failed!');
                }
        }
        return view('credit-quote', compact('payload','request')+['meter_data'=>$this->meter_data]);

    }

    public function topup(Request $request){
        $payload=[];
        if ($request->isMethod('post')) {

                $validated=$request->validate([
                        'location' => 'required|string',
                        'meteringSystem' => 'required|string',
                        'amount' => 'required|numeric|min:1|confirmed'
                ]);

                $vendorId=null;
                $regionId=null;
                $districtId=null;

                foreach($this->meter_data as $meter){

                    if($meter['location']==$validated['location'] && $meter['meteringSystem']==$validated['meteringSystem']){
                        $vendorId=$meter['vendorId'];
                        $regionId=$meter['regionId'];
                        $districtId=$meter['districtId'];

                        break;
                    }
                }

                if($vendorId==null){
                    return redirect()->back()->with('warning', 'Invalid metering system or location!');
                }

                $ecollect_base_url=config('tgl.ecollect_base_url');
                $auth_profile=config('tgl.auth_profile');
                $uniqueString = substr(str_replace('.','',uniqid('', true)), 0, 16) ;
                $authorization = hash('sha256',$auth_profile.$uniqueString,);
                $ecollect_referrer=config('tgl.ecollect_referrer');
                $ecollect_apikey=config('tgl.ecollect_api_key');

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'referer'=>$ecollect_referrer,
                    'api-key'=>$ecollect_apikey,
                    'Authorization'=>$authorization,
                ])
                ->post($url="$ecollect_base_url/ECGQuotaTopup", [
                        "consumerVersion" => "1",
                        "requestDate" => date("Y-m-d H:i:s"),
                        "requestId" => $uniqueString,
                        "vendorId" => $vendorId,
                        "regionId" => $regionId,
                        "districtId" => $districtId,
                        "meterProvider" => $validated['meteringSystem'],
                        "amount" => $validated['amount'],
                        "callbackURL" => "https://ecgfdapim.azurefd.net/ECGUnifiedQuotaCallback"
                ]);

                if($response->successful()){
                    $payload=$response->json();

                    if(isset($payload['status']['code']) && $payload['status']['code']!='0'){
                        return redirect()->back()->with('warning', $payload['status']['message']);
                    }

                    session()->flash('success', 'Quota topup successful!');
                }
                else
                {
                    $this->logHttpError('Quota topup failed:', $response);

                    $payload=$response->json();

                    return redirect()->back()->with('warning', $payload['status']['message'] ?? 'Quota topup failed!');
                }
        }
        return view('quota-topup',compact('request') + ['meter_data'=>$this->meter_data,'payload']);
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
