<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\CustomerTransactionSummary;
use Illuminate\Support\Facades\Validator;
use App\Models\ViewMainTransaction;
use Carbon\Carbon;

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
            $query=$query->where(function ($q) use ($search,$d_from,$d_to) {
                $q->whereBetween('created_at',[$d_from,$d_to]);
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

    public function top_selling_cutomers(Request $request)
    {
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = CustomerTransactionSummary::select([
            'senderID',
            'created_at',
            'country',
            'phoneNum',
            'fullName',
            'gender',
            'postcode',
            'addressline1',
            //'transactionStatus',
            'totalAmount',
            'numTransactions'
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
                    ->orWhere('senderID', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('phoneNum', 'like', "%{$search}%")
                    ->orWhere('fullName', 'like', "%{$search}%")
                    ->orWhere('postcode', 'like', "%{$search}%")
                    ->orWhere('addressLine1', 'like', "%{$search}%");
                    //->orWhere('transactionStatus', 'like', "%{$search}%");
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

    public function profile(Customer $profile){
       $payload=[
            'profile'=>$profile->only(
             'phoneNum',
             'fullName',
             'gender',
             'email',
             'idType',
             'idNumber',
             'dob',
             'addressLine1',
             'postcode',
             'accountType',
             'status'
            )+[
               'credit'=>  $profile->customer_account->credit,
                'debit'=>   $profile->customer_account->debit,
                 'balance'=> $profile->customer_account->balance,
            ]
       ];

        return response()->json([
            'message' => 'Customer profile retrieved',
            'data' => $payload,
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
            'customer_tbl.id',
            'customer_tbl.created_at',
            'birthCountry',
            'phoneNum',
            'fullName',
            'customer_tbl.gender',
            //'gps',
            'addressLine1',
            'dob',
            'district',
            'region',
            'nationality',
            'idNumber',
        ])
        ->join('users', 'users.uuid', '=', 'customer_tbl.id')
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

    public function create_system_account(Request $request){

        $validator = Validator::make($request->all(), [
             'phoneNum' => 'required|numeric',
             'password' => 'required|string|confirmed',
             'fullName' => 'required|string|max:100',
             'accountType' => 'required|in:2,3',
             'country' => 'required|in:GH',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode'=>'400',
                'message' => $validator->errors()->first(),
                'data'=>null
            ], 400);
        }


        // ✅ Get validated data
        $validated = $validator->validated();

        // ✅ Map form fields to DB fields
        $customer = Customer::updateOrCreate(
            [
                'fullName' => $validated['fullName'],
                'phoneNum' => $validated['phoneNum'],
                'accountType'      => $validated['accountType'],
                'country' => $validated['country'],
            ],
            [
                'password' => $validated['password'],
                'password' => $validated['password'],
            ]
        );


        if($customer->customer_account){
            $customer->customer_account()->create([
                'credit'=>0,
                'debit'=>0,
            ]);
        }

        return response()->json([
            'statusCode'=>'200',
            'message' => 'Customer created successfully',
            'data'    => $customer
        ], 200);
    }

    public function update_customer(Request $request,Customer $profile){

        $validator = Validator::make($request->all(), [
             'accountType' => 'required|exists:accounttype_tbl,id',
             'status' => 'required|in:ACTIVE,INACTIVE,SUSPENDED'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode'=>'400',
                'message' => $validator->errors()->first(),
                'data'=>null
            ], 400);
        }


        // ✅ Get validated data
        $validated = $validator->validated();

        $profile->update([
            'accountType'=>$validated['accountType'],
            'status'=>$validated['status'],
        ]);

        return response()->json([
            'statusCode'=>'200',
            'message' => 'Customer updated successfully',
            'data'    => $profile
        ], 200);
    }

    public function system_accounts(Request $request)
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
            'customer_tbl.id',
            'customer_tbl.created_at',
            'countryResidence',
            'phoneNum',
            'customer_tbl.fullName',
            'gender',
            'uGroup',
            'groupName',
            'status'
        ])
        ->join('customeraccount_tbl', 'customeraccount_tbl.customerID', '=', 'customer_tbl.id')
        ->join('ugroup_tbl', 'ugroup_tbl.id', '=', 'customer_tbl.uGroup');

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search) {
                $q->whereBetween('customer_tbl.created_at', $d_from,$d_to);
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
            ->orderBy('customer_tbl.created_at', 'desc')
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

    public function active_customers(Request $request){
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search
        $months = $request->input('months'); // global search

        // Base query
        $query = ViewMainTransaction::select([
            'created_at',
            'customer',
            'senderID',
            'b_bus_id',
            'transaction_uid',
            'transaction_type',
            'transactionStatus',
            'purpose',
            'sendersAmount',
            'fee',
            'billCode',
            'bill_type',
            'airtimeNumber',
            'remitRecipientMomoName',
            'remitRecipientMomoNumber',
            'remitRecipientBankName',
            'remitRecipientBankAccount',
            'remitRecipientBankAccountName',
            'async_id',
            'app_version',
        ])
        ->where('created_at', '>=', Carbon::now()->subMonths($months));

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search,$d_from,$d_to) {
                $q->whereBetween('created_at', [$d_from,$d_to]);
            });
        }

       if (!empty($search)) {
            $fields = [
                'created_at',
                'customer',
                'b_bus_id',
                'transaction_uid',
                'transaction_type',
                'transactionStatus',
                'purpose',
                'sendersAmount',
                'fee',
                'billCode',
                'bill_type',
                'airtimeNumber',
                'remitRecipientMomoName',
                'remitRecipientMomoNumber',
                'remitRecipientBankName',
                'remitRecipientBankAccount',
                'remitRecipientBankAccountName',
                'async_id',
                'app_version',
            ];

            $query->where(function ($q) use ($search, $fields) {
                foreach ($fields as $field) {
                    $q->orWhere($field, 'like', "%{$search}%");
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
}
