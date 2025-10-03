<?php

namespace App\Http\Controllers\Apis;
use App\Models\PricingPolicy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;



class PricingPoliciesController extends Controller
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
        $query = PricingPolicy::query()
                ->select(
                    'pricing_policy_tbl.id',
                    'pricing_policy_tbl.senderUGroup as senderUGroupId',
                    'pricing_policy_tbl.recipientUGroup as recipientUGroupId',
                    'pricing_policy_tbl.senderAccountType as senderAccountTypeId',
                    'pricing_policy_tbl.recipientAccountType as recipientAccountTypeId',
                    'pricing_policy_tbl.serviceType as serviceTypeId',
                    'services.serviceName as serviceType',
                    'senderGroup.groupName as senderGroup',
                    'recipientGroup.groupName as recipientGroup',
                    'senderAcc.accountType as senderAccountType',
                    'recipientAcc.accountType as recipientAccountType',
                    'pricing_policy_tbl.priceType',
                    'pricing_policy_tbl.price_in_percent_absolute as price',
                    'pricing_policy_tbl.senderCountry',
                    'pricing_policy_tbl.recipientCountry',
                    'pricing_policy_tbl.sysCommission',
                    'pricing_policy_tbl.senderCommission',
                    'pricing_policy_tbl.recipientCommission'
                )
                ->leftJoin('ugroup_tbl as senderGroup', 'pricing_policy_tbl.senderUGroup', '=', 'senderGroup.id')
                ->leftJoin('ugroup_tbl as recipientGroup', 'pricing_policy_tbl.recipientUGroup', '=', 'recipientGroup.id')
                ->leftJoin('accounttype_tbl as senderAcc', 'pricing_policy_tbl.senderAccountType', '=', 'senderAcc.id')
                ->leftJoin('accounttype_tbl as recipientAcc', 'pricing_policy_tbl.recipientAccountType', '=', 'recipientAcc.id')
                ->leftJoin('services_tbl as services', 'pricing_policy_tbl.serviceType', '=', 'services.id');

        $recordsTotal = $query->count();

        if (!empty($search)) {
                $searchable = [
                    'services_tbl.serviceName',
                    'senderGroup.groupName',
                    'recipientGroup.groupName',
                    'senderAcc.accountType',
                    'recipientAcc.accountType',
                    'pricing_policy_tbl.price_in_percent_absolute',
                    'pricing_policy_tbl.senderCountry',
                    'pricing_policy_tbl.recipientCountry',
                    'pricing_policy_tbl.sysCommission',
                    'pricing_policy_tbl.senderCommission',
                    'pricing_policy_tbl.recipientCommission',
                ];

                $pricings->where(function ($q) use ($searchable, $search) {
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
        $prices = $query
            ->orderBy('pricing_date', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $prices,
        ]);
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'senderGroup'          => 'required|integer',
            'recipientGroup'       => 'required|integer',
            'sendersAccountType'   => 'required|integer',
            'recipientAccountType' => 'required|integer',
            'serviceType'          => 'required|integer',
            'priceType'            => 'required|in:ABSOLUTE,PERCENTAGE',
            'price'                => 'required|numeric|min:0',
            'senderCountry'        => 'required|string|max:5',
            'recipientCountry'     => 'required|string|max:5',
            'sysCommission'        => 'required|numeric|min:0',
            'senderCommission'     => 'required|numeric|min:0',
            'recipientCommission'  => 'required|numeric|min:0',
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

        #return $validated;

        // ✅ Map form fields to DB fields
        $pricing = PricingPolicy::updateOrCreate(
    [
        'senderUGroup'         => $validated['senderGroup'],
        'recipientUGroup'      => $validated['recipientGroup'],
        'senderAccountType'    => $validated['sendersAccountType'],
        'recipientAccountType' => $validated['recipientAccountType'],
        'serviceType'          => $validated['serviceType']
    ],
    [
        'priceType'                => $validated['priceType'],
        'price_in_percent_absolute'=> $validated['price'],
        'senderCountry'            => $validated['senderCountry'],
        'recipientCountry'         => $validated['recipientCountry'],
        'sysCommission'            => $validated['sysCommission'],
        'senderCommission'         => $validated['senderCommission'],
        'recipientCommission'      => $validated['recipientCommission'],
        'pricing_by'               => auth()->id(),
        'pricing_date'             => now(),
    ]
);


        return response()->json([
            'statusCode'=>'200',
            'message' => 'Pricing saved successfully',
            'data'    => $pricing
        ], 200);
    }

    public function show(PricingPolicy $price){
          return response()->json([
            'statusCode'=>'200',
            'message' => 'Pricing details',
            'data'    => $price
        ], 200);
    }
}
