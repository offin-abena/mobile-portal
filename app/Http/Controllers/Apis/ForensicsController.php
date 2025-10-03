<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViewFullTransaction;

class ForensicsController extends Controller
{
    public function index(Request $request){
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = ViewFullTransaction::query();

        $recordsTotal = $query->count();

        // Filtering
        if(!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search,$d_from,$d_to) {
                $q->whereBetween('Date', [$d_from,$d_to]);
            });
        }

        if (!empty($search)) {
            $query=$query->where(function ($q) use ($search) {
                $q->where('Account', 'like', "%{$search}%")
                  ->orWhere('Full Name', 'like', "%{$search}%")
                  ->orWhere('Fund Source Provider', 'like', "%{$search}%")
                  ->orWhere('Fund Source Number', 'like', "%{$search}%")
                  ->orWhere('Fund Source Name', 'like', "%{$search}%")
                  ->orWhere('T-Type', 'like', "%{$search}%")
                  ->orWhere('Trnx ID', 'like', "%{$search}%")
                  ->orWhere('T-Status', 'like', "%{$search}%")
                  ->orWhere('Momo Recipient Name', 'like', "%{$search}%")
                  ->orWhere('Momo Recipient Number', 'like', "%{$search}%")
                  ->orWhere('Bank Recipient Name', 'like', "%{$search}%")
                  ->orWhere('Bank Name', 'like', "%{$search}%")
                  ->orWhere('Bank Account Number', 'like', "%{$search}%")
                  ->orWhere('B_BUS_ID', 'like', "%{$search}%");
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
        $referrers = $query
            ->orderBy('Date', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $referrers,
        ]);
    }
}
