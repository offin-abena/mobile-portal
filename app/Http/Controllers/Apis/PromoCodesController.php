<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromoCodesController extends Controller
{
    public function index(Request $request)
    {
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = PromoCode::select([
            'date',
            'promo_code',
            'amount',
            'status',
            'provider',
            'start_date',
            'expiry_date',
            'used_date',
            'used_by'
        ]);

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search) {
                $q->whereBetween('date', $d_from,$d_to);

            });
        }

        $recordsFiltered = $query->count();

        // Pagination + ordering
        $payments = $query
            ->orderBy('date', 'desc')
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
