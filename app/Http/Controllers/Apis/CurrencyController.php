<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
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
        $query = Currency::query()
                ->select(
                    'currencyexchange_tbl.id',
                    'convertFrom',
                    'convertTo',
                    'conversionRate',
                    'dateTime',
                    'admins.fullName',
                    'updated_date',
                )->join('admins','admins.id','=','currencyexchange_tbl.updated_by');

        $recordsTotal = $query->count();

        if (!empty($search)) {
                $searchable = [
                    'convertFrom',
                    'convertTo',
                    'conversionRate',
                    'dateTime',
                    'admins.fullName',
                    'updated_date'
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
        $currencies = $query
            ->orderBy('updated_date', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $currencies,
        ]);
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
             'conversionRate' => 'required|numeric|min:1',
             'currencyId' => 'required|numeric|min:1'
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

        $currency=Currency::where('id',$validated['currencyId'])
                  ->update(['conversionRate'=>$validated['conversionRate']]);


        return response()->json([
            'statusCode'=>'200',
            'message' => 'Currency updated successfully',
            'data'    => $currency
        ], 200);
    }
}
