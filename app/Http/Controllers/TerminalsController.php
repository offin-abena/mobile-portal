<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;


class TerminalsController extends Controller
{
    use LogsHttpErrors;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

       /*  try{
        $url=config('tgl.ecollect_base_url');

         $response =Http::retry(3, 200)->withOptions(['verify' => false])->withHeaders([
                    'Authorization' => 'ffee9eb7e0cf726525d316cf508094a81049ecd363c85a397a1919c8aa5fccea',
                    'Content-Type' => 'application/json',
                ])
                ->post("{$url}/GetMerchants", [
                    'terminalId' => '10000007',
                    'asyncRequestId' => '6ed35554-14e5-46d8-b91a-bceddc0e7e9c'
                ]);


        $merchants=[];
        if($response->successful()){

            $payload=$response->json();

            if($payload['status']['code']!='0'){
                  return response()->json([
                    'status' => 'failed',
                    'message' => $payload['status']['message'],
                    'data' => null,
                ],404);
            }

            $merchants= $payload['merchants'];

        }

        }
        catch(\Illuminate\Http\Client\RequestException  $ex){
            $this->logHttpError($ex->getMessage(),response());
        } */

        //dd($merchants);

        return view('increase-vendor-terminal');
    }

    public function process(Request $request){

        $token=$this->get_token();

        $url = 'https://webvendingprod.tglvendors.com:86/api/Vendor/ModifyAllowedTerminals';

        $validated=$request->validate([
                        'vendorId' => 'required',
                        'siteId' => 'required',
                        'number'=>'required'
        ]);


        $data = [
            "vendorId" => $validated['vendorId'],
            "siteCode" => $validated['siteId'],
            "terminalCount" => $validated['number']
        ];


         $response = Http::withOptions(['verify' => false])->withHeaders([
                    'Authorization' => "Bearer {$token}",
                    'Content-Type' => 'application/json',
                ])
                ->post($url, $data);


        if($response->successful()){

            return response()->json(['message'=>'Operation successful']);
        }
        else{
             return response()->json(['failed'=>'Operation successful'],400);
        }
    }

    private function get_token(){
         $url = 'https://webvendingprod.tglvendors.com:86/api/Login/Authenticate';

         $response = Http::withOptions(['verify' => false])->withHeaders([
                    'Content-Type' => ' application/json'
                ])
                ->post($url, [
                   'mobileNumber' => '0338833224',
                   'password' => 'P@$$w0rd',
                ]);

         if($response->successful()){
             $payload=$response->json();

             return $payload['token'];
         }
    }
}
