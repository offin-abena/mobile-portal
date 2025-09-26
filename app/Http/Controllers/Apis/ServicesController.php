<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
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
        $query = Service::query()
                ->select(
                    'services_tbl.id',
                    'general_service',
                    'serviceName',
                    'senderCountry',
                    'recipientCountry',
                    'minimum',
                    'maximum',
                    'added_by',
                    'dateTime',
                    'admins.fullName'
                )
                ->leftJoin('admins', 'services_tbl.added_by', '=', 'admins.id');

        $recordsTotal = $query->count();

        if (!empty($search)) {
                $searchable = [
                    'general_service',
                    'serviceName',
                    'senderCountry',
                    'recipientCountry',
                    'minimum',
                    'maximum',
                    'added_by',
                    'dateTime',
                    'admins.fullName'
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
        $services = $query
            ->orderBy('dateTime', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $services,
        ]);
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
             'countryCode' => 'required|string|max:5',
             'general' => 'required|string|max:50',
             'serviceName' => 'required|string|max:100',
             'minimum' => 'required|numeric|min:0',
             'maximum' => 'required|numeric|gte:minimum',
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
        $service= Service::updateOrCreate(
            [
                'senderCountry' => $validated['countryCode'],
                'recipientCountry' => $validated['recipientCountry']??'GH',
                'general_service'      => $validated['general'],
                'serviceName' => $validated['serviceName'],
            ],
            [
                'minimum' => $validated['minimum'],
                'maximum' => $validated['maximum'],
                'added_by'=> \Auth::user()->id
            ]
        );

        return response()->json([
            'statusCode'=>'200',
            'message' => 'Service created successfully',
            'data'    => $service
        ], 200);
    }
}
