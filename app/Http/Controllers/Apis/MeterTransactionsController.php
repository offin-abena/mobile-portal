<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\LogsHttpErrors;
use Illuminate\Support\Facades\Http;
use DateTime;
use DateTimeZone;

class MeterTransactionsController extends Controller
{
    use LogsHttpErrors;

    public function __construct()
    {
        //$this->middleware('auth');
    }

   public function index(Request $request)
   {
       try{
            $draw = $request->get('draw');
            $start = $request->get('start', null); // DataTables skip parameter
            $length = $request->get('length', 2000); // DataTables limit parameter
            $searchValue = $request->get('search')['value'] ?? '';
            $orderColumn = $request->get('order')[0]['column'] ?? 0;
            $orderDir = $request->get('order')[0]['dir'] ?? 'asc';
            $columns = $request->get('columns', []);
            $meterNumber = $request->get('meterNumber', null);


            $api_id=config('tgl.subs_api_id');
            $api_key=config('tgl.subs_api_key');

            $date = new DateTime('now', new DateTimeZone('UTC'));
            $formattedDate = $date->format('Y-m-d\TH:i:s.v\Z');
            $timestamp = $formattedDate;

            $sub_base_url=config('tgl.subs_base_url');

            $url="$sub_base_url/payments/?timestamp=$timestamp&skip=$start&limit=$length";

            if($meterNumber){
                $url.="&meterNumber=$meterNumber";
            }


            $message = $timestamp.$api_id;
            $signature = base64_encode(hash_hmac("sha256", $message, $api_key, true));



            $response = Http::timeout(512)->withHeaders([
                'Content-Type' => 'application/json',
                'api-id'=>$api_id,
                'signature'=>$signature
            ])->get($url);

            $resp=$response->json();


            $totalRecords = $resp['limit'];
            $filteredRecords = count($resp['rows']) ?? $totalRecords;

            if($response->successful()){
                return response()->json([
                    'draw' => intval($draw),
                    'recordsTotal' => $totalRecords,
                    'recordsFiltered' => $filteredRecords,
                    'data' => $resp['rows']
                ],);
            }

       }
       catch(Exception $e){
            $this->logHttpError('Meter Transactions failed:', $response);
            return response()->json([
                'error' => 'An error occurred while fetching data.',
                'message' => $e->getMessage()
            ], 500);
       }
   }
}
