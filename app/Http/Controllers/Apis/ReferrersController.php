<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referrer;
use Illuminate\Support\Facades\Validator;

class ReferrersController extends Controller
{
    public function index(Request $request){
       // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = Referrer::select([
            'id',
            'created_at',
            'fullName',
            'phone',
            'email',
            'gender',
            'region',
            'referrer_type',
            'code'
        ]);

        $recordsTotal = $query->count();

        // Filtering
        if(!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search,$d_from,$d_to) {
                $q->whereBetween('created_at', [$d_from,$d_to]);
            });
        }

        if (!empty($search)) {
            $query=$query->where(function ($q) use ($search) {
                $q->where('fullName', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('gender', 'like', "%{$search}%")
                  ->orWhere('region', 'like', "%{$search}%")
                  ->orWhere('referrer_type', 'like', "%{$search}%");
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
        $referrers = $query
            ->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $referrers,
        ]);
    }

    public function save(Request $request,$id=null){

       $validator = Validator::make($request->all(), [
             'fullName' => 'required|string',
             'code' => 'required|unique:referrers,code'. ($id? ','. $id:''),
             'phone' => 'required|unique:referrers,phone' .  ($id? ','. $id:''),
             'email' => 'required|unique:referrers,email' . ($id? ','. $id:''),
             'gender' => 'required|in:male,female',
             'region' => 'required|string',
             'referrer_type' => 'required|in:internal,external'
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


        if($id){
           $referrer=Referrer::find($id);
           $referrer->update([
                'fullName'=>$validated['fullName'],
                'phone'=>$validated['phone'],
                'email'=>$validated['email'],
                'gender'=>$validated['gender'],
                'gender'=>$validated['gender'],
                'region'=>$validated['region'],
                'code'=>$validated['code'],
                'referrer_type'=>$validated['referrer_type'],
           ]);
        }
        else{
            $referrer=Referrer::create([
                'fullName'=>$validated['fullName'],
                'phone'=>$validated['phone'],
                'email'=>$validated['email'],
                'gender'=>$validated['gender'],
                'gender'=>$validated['gender'],
                'region'=>$validated['region'],
                'code'=>$validated['code'],
                'referrer_type'=>$validated['referrer_type'],
             ]);
        }

        return response()->json([
            'statusCode'=>'200',
            'message' => 'Referrer saved successfully',
            'data'    => $referrer->refresh()
        ], 200);

    }
}
