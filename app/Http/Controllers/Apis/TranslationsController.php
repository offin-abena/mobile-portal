<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Translation;

class TranslationsController extends Controller
{
    public function index(Request $request){
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search

        // Base query
        $query = Translation::query();

        $recordsTotal = $query->count();

        if (!empty($search)) {
            $query=$query->where(function ($q) use ($search) {
                $q->where('category', 'like', "%{$search}%")
                  ->orWhere('feature', 'like', "%{$search}%")
                  ->orWhere('platform', 'like', "%{$search}%")
                  ->orWhere('keyz', 'like', "%{$search}%")
                  ->orWhere('textz', 'like', "%{$search}%")
                  ->orWhere('english', 'like', "%{$search}%")
                  ->orWhere('french', 'like', "%{$search}%")
                  ->orWhere('pidgin', 'like', "%{$search}%")
                  ->orWhere('swahili', 'like', "%{$search}%")
                  ->orWhere('spanish', 'like', "%{$search}%")
                  ->orWhere('arabic', 'like', "%{$search}%");
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
        $settlements = $query
            ->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $settlements,
        ]);
    }

    public function save(Request $request,Translation $translation=null){

         $validator = Validator::make($request->all(), [
             'platform' => 'required|in:mobile,web,ussd',
             'category' => 'required|string',
             'feature' => 'required|string',
             'key' => 'required|string',
             'text' => 'required|string',
             'pidgin' => 'required|string',
             'english' => 'required|string',
             'french' => 'required|string',
             'spanish' => 'required|string',
             'swahili' => 'required|string',
             'arabic' => 'required|string',
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

        if($translation){
            $translation->update([
                    'platform'=>$validated['platform'],
                    'category'=>$validated['category'],
                    'feature'=>$validated['feature'],
                    'textz'=>$validated['text'],
                    'english'=>$validated['english'],
                    'pidgin'=>$validated['pidgin'],
                    'french'=>$validated['french'],
                    'spanish'=>$validated['spanish'],
                    'swahili'=>$validated['swahili'],
                    'arabic'=>$validated['arabic'],
                ]);
        }
        else{
            $translation=Transaction::create([
                    'platform'=>$validated['platform'],
                    'category'=>$validated['category'],
                    'feature'=>$validated['feature'],
                    'textz'=>$validated['text'],
                    'english'=>$validated['english'],
                    'pidgin'=>$validated['pidgin'],
                    'french'=>$validated['french'],
                    'spanish'=>$validated['spanish'],
                    'swahili'=>$validated['swahili'],
                    'arabic'=>$validated['arabic'],
            ]);
        }


        return response()->json([
            'statusCode'=>'200',
            'message' => 'Translation saved successfully',
            'data'    => $translation
        ], 200);
    }
}
