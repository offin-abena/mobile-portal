<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserEcgMter;

class MetersController extends Controller
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
        $query = UserEcgMter::select([
            'created_at',
            'meter_no',
            'meter_info'

        ]);

        $recordsTotal = $query->count();

        if (!empty($search)) {
            $query=$query->where(function ($q) use ($search) {
                $q->where('meter_no', 'like', "%{$search}%")
                  ->orWhere('meter_info', 'like', "%{$search}%");
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
        $meters = $query
            ->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $meters,
        ]);
    }
}
