<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;

class CustomersController extends Controller
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
        $query = Customer::select([
            'created_at',
            'birthCountry',
            'phoneNum',
            'fullName',
            'gender',
            'postcode',
            'addressLine1',
            'dob',
            'addressLine2',
            'region',
            'nationality',
            'idNumber',
            'status'
        ]);

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search) {
                $q->whereBetween('created_at', $d_from,$d_to);
            });
        }

        if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('created_at', 'like', "%{$search}%")
                    ->orWhere('birthCountry', 'like', "%{$search}%")
                    ->orWhere('phoneNum', 'like', "%{$search}%")
                    ->orWhere('fullName', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%")
                    ->orWhere('postcode', 'like', "%{$search}%")
                    ->orWhere('addressLine1', 'like', "%{$search}%")
                    ->orWhere('dob', 'like', "%{$search}%")
                    ->orWhere('addressLine2', 'like', "%{$search}%")
                    ->orWhere('region', 'like', "%{$search}%")
                    ->orWhere('nationality', 'like', "%{$search}%")
                    ->orWhere('idNumber', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
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
        $customers = $query
            ->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $customers,
        ]);

    }

    public function referred(Request $request)
    {
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = Customer::select([
            'id',
            'created_at',
            'birthCountry',
            'phoneNum',
            'name',
            'gender',
            'gps',
            'addressLine1',
            'dob',
            'district',
            'region',
            'nationality',
            'idNumber',
        ])
        ->join('users', 'users.uuid', '=', 'customers.id')
        ->whereNotNull('users.referral_code');

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search) {
                $q->whereBetween('created_at', $d_from,$d_to);
            });
        }

        $recordsFiltered = $query->count();

        // Pagination + ordering
        $payments = $query
            ->orderBy('created_at', 'desc')
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
