<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\ActivityLog;

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
            'id',
            'fullName',
            'username',
            'userType',
            'adminID',
            'status'
        ]);

        $recordsTotal = $query->count();

        // Filtering
        if(!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search) {
                $q->whereBetween('created_at', $d_from,$d_to);
            });
        }

        if (!empty($search)) {
            $query=$query->where(function ($q) use ($search) {
                $q->where('fullName', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('userType', 'like', "%{$search}%")
                  ->orWhere('adminID', 'like', "%{$search}%")
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
}
