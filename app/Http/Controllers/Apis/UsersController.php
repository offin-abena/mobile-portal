<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    public function admins(Request $request)
    {
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = Admin::select([
            'admins.id',
            'admins.fullName',
            'admins.userCountry',
            'admins.phoneNum',
            'admins.username',
            'admins.email',
            'admins.userType',
            'admins.adminID',
            'b.fullName as AdminName',
            'admins.status',
            'admins.created_at'
        ])->leftJoin('admins as b','admins.adminID','=','b.id');

        $recordsTotal = $query->count();

        // Filtering
        if(!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search) {
                $q->whereBetween('created_at', $d_from,$d_to);
            });
        }
        if (!empty($search)) {
            $query=$query->where(function ($q) use ($search) {
                $q->where('admins.fullName', 'like', "%{$search}%")
                  ->orWhere('b.fullName ', 'like', "%{$search}%")
                  ->orWhere('admins.email ', 'like', "%{$search}%")
                  ->orWhere('admins.username', 'like', "%{$search}%")
                  ->orWhere('admins.userType', 'like', "%{$search}%")
                  ->orWhere('admins.adminID', 'like', "%{$search}%")
                  ->orWhere('admins.status', 'like', "%{$search}%");
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
        $admins = $query
            ->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $admins,
        ]);
    }

    public function audit_trail(Request $request)
    {
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = ActivityLog::select([
                    'dateTime',
                    'admins.username as username',
                    'action',
                    'activity',
                ])->join('admins', 'admins.id', '=', 'activity_log.userID');

        $recordsTotal = $query->count();
        // Filtering
        if (!empty($search)) {
            $query=$query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('action', 'like', "%{$search}%")
                  ->orWhere('activity', 'like', "%{$search}%");
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
        $audit_logs = $query
            ->orderBy('dateTime', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $audit_logs,
        ]);
    }

    public function create_admin(Request $request){

         $validator = Validator::make($request->all(), [
            'phoneNum'          => 'required|string',
            'password'       => 'required|sometimes|nullable|string|min:6',
            //'password_confirmation'       => 'required|sometimes|nullable|string|confirmed',
            'fullName'   => 'required|string',
            'accountType' => 'required|in:SYSTEMADMIN,ADMINISTRATOR,MANAGER,OPERATIONS,VMANAGER,ACCOUNTANT,COMPLIANCE,FRONTDESK',
            'country'          => 'required|in:GH'
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
        $pricing = Admin::updateOrCreate(
            [
                'fullName'         => $validated['fullName'],
                'userType'      => $validated['accountType'],
                'phoneNum'    => $validated['phoneNum'],
                'userCountry' => $validated['country'],
            ],
            [
                'password'                => $validated['password'],
                'adminID'               => auth()->id(),
            ]
        );


        return response()->json([
            'statusCode'=>'200',
            'message' => 'Admin saved successfully',
            'data'    => $pricing
        ], 200);
    }

    public function change_status_admin(Request $request){

         $validator = Validator::make($request->all(), [
            'status'   => 'required|in:ACTIVE,INACTIVE',
            'id'       => 'required|exists:admins,id'
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
        $admin = Admin::find($validated['id']);

        $admin->update(['status'=>$validated['status']]);

        return response()->json([
            'statusCode'=>'200',
            'message' => 'Admin saved successfully',
            'data'    => $admin
        ], 200);
    }
}
