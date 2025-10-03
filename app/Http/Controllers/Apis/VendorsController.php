<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EcgNewData;
use Illuminate\Support\Facades\Http;
use App\Traits\LogsHttpErrors;



class VendorsController extends Controller
{
    use LogsHttpErrors;

    public function search(Request $request){
        $vendors = EcgNewData::where('vendorName', 'like', '%' . $request->q . '%')
        ->orWhere('phoneNumber', 'like', '%' . $request->q . '%')
        ->orWhere('vendorId', 'like', '%' . $request->q . '%')
        ->get();


        return response()->json([
            'status' => 'success',
            'message' => 'Vendor search endpoint',
            'data' => $vendors,
        ]);

    }

    public function search_tgl_vendors(Request $request){

        $url=config('tgl.ecollect_base_url');

         $response = Http::withOptions(['verify' => false])->withHeaders([
                    'Authorization' => 'ffee9eb7e0cf726525d316cf508094a81049ecd363c85a397a1919c8aa5fccea',
                    'Content-Type' => 'application/json',
                ])
                ->post("{$url}/GetMerchants", [
                    'terminalId' => '10000007',
                    'asyncRequestId' => '6ed35554-14e5-46d8-b91a-bceddc0e7e9c'
                ]);


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

            //return $merchants;



            return response()->json([
                'status' => 'success',
                'message' => 'Vendor list',
                'data' =>  $merchants,
            ]);
        }


         return response()->json([
                    'status' => 'error',
                    'message' => 'No record found',
                    'data' => null,
                ],400);


    }
    public function branches(Request $request, $vendor){
         $url=config('tgl.ecollect_base_url');

         $response = Http::withOptions(['verify' => false])->withHeaders([
                    'Authorization' => 'ffee9eb7e0cf726525d316cf508094a81049ecd363c85a397a1919c8aa5fccea',
                    'Content-Type' => 'application/json',
                ])
                ->post("{$url}/GetMerchantSites", [
                    'terminalId' => '10000007',
                    'merchantId' => "{$vendor}",
                    'asyncRequestId' => '6ed35554-14e5-46d8-b91a-bceddc0e7e9c'
                ]);

         if($response->successful()){

            $payload=$response->json();


            if($payload['status']['code']!='0'){
                  return response()->json([
                    'status' => 'failed',
                    'message' => $payload['status']['message'],
                    'data' => null,
                ],404);
            }

            $sites= $payload['sites'];

            return response()->json([
                'status' => 'success',
                'message' => 'Sites list',
                'data' => $sites,
            ]);
        }

        return response()->json([
                    'status' => 'error',
                    'message' => 'No record found',
                    'data' => null,
                ],400);

    }
    public function vendorDatabase(Request $request){
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        //$d_from = $request->input('d_from'); // global search
        //$d_to = $request->input('d_to'); // global search

        // Base query
        $query = EcgNewData::select([
            'district',
            'meteringSystem',
            'phoneNumber',
            'region',
            'regionId',
            'districtid',
            'CMSID',
            'vendorId',
            'vendorName',
            'vendorStatus',

        ]);

        $recordsTotal = $query->count();

        if (!empty($search)) {
            $query=$query->where(function ($q) use ($search) {
                $q->where('district', 'like', "%{$search}%")
                  ->orWhere('meteringSystem', 'like', "%{$search}%")
                  ->orWhere('region', 'like', "%{$search}%")
                  ->orWhere('regionId', 'like', "%{$search}%")
                  ->orWhere('districtid', 'like', "%{$search}%")
                  ->orWhere('CMSID', 'like', "%{$search}%")
                  ->orWhere('vendorId', 'like', "%{$search}%")
                  ->orWhere('vendorName', 'like', "%{$search}%")
                  ->orWhere('vendorStatus', 'like', "%{$search}%");
            });
        }

        if ($request->has('order')) {

            $orderColumnIndex = $request->input('order.0.column');   // index of column
            $orderDir = $request->input('order.0.dir', 'asc');      // direction: asc or desc
            $orderColumn = $request->input("columns.$orderColumnIndex.data"); // column name from DataTables

            if (!empty($orderColumn)) {
                $query->orderBy($orderColumn, $orderDir);
            }
        }

        $recordsFiltered = $query->count();

        // Pagination + ordering
        $payments = $query
            ->orderBy('vendorId', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $payments,
        ]);
    }
}
