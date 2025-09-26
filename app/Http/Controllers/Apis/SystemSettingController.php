<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Validator;


class SystemSettingController extends Controller
{
    public function index(Request $request){

        $settings = SystemSetting::first();

        return response()->json([
            'statusCode'=>'200',
            'message' => 'System settings',
            'data'    => $settings
        ], 200);
     }

     public function toggle_status(Request $request){

        $validator = Validator::make($request->all(), [
             'service' => 'required|in:mobile,ussd,brassica,b_bus,bank_transfer,airtime_purchase,momo_transfer,legacy_quote,tgl_mobile_vendor,tgl_utility_app',
             'state' => 'required|string|in:1,0'
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

        $setting=SystemSetting::first();

        $payload=['allow_'.$validated['service'].'_access'=>$validated['state']];

        //return $payload;

        $setting->update($payload);


        return response()->json([
            'statusCode'=>'200',
            'message' => 'Service status toggled successfully',
            'data'    => $setting->refresh()
        ], 200);
     }
}
