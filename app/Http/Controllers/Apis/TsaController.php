<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TsaTm;

class TsaController extends Controller
{
    public function index(Request $request){
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        //$d_from = $request->input('d_from'); // global search
        //$d_to = $request->input('d_to'); // global search

        // Base query
        $query = TsaTm::select([
            'phone_num',
            'reference_code',
            'full_name',
            'status',
            'current_otp',
            'hashed_current_otp',
            'password',
            'amount_limit',
            'created_at'

        ]);

        $recordsTotal = $query->count();

        if (!empty($search)) {
            $query=$query->where(function ($q) use ($search) {
                $q->where('phone_num', 'like', "%{$search}%")
                  ->orWhere('reference_code', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('amount_limit', 'like', "%{$search}%");
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
        $managers = $query
            ->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $managers,
        ]);
    }
}
