<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kyc;

class kycsController extends Controller
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
        $query = Kyc::query()
                ->select(
                    'id',
                    'countryCode',
                    'name',
                    'dailyAmount',
                    'monthlyAmount',
                    'balance',
                    'transaction_limit'
                );

        $recordsTotal = $query->count();

        if (!empty($search)) {
                $searchable = [
                    'countryCode',
                    'name',
                    'dailyAmount',
                    'monthlyAmount',
                    'balance',
                    'transaction_limit'
                ];

                $query->where(function ($q) use ($searchable, $search) {
                    foreach ($searchable as $column) {
                        $q->orWhere($column, 'like', "%{$search}%");
                    }
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
        $kycs = $query
            ->orderBy('name', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $kycs,
        ]);
    }
}
