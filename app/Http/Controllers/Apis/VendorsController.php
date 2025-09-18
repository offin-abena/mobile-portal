<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EcgNewData;

class VendorsController extends Controller
{
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
