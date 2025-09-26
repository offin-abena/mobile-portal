<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintransaction;

class DashboardController extends Controller
{
    function get_special_transactions_summary($from,$to){

        $transactions = Maintransaction::query()->selectRaw('COUNT(*) as count, SUM(sendersAmount) as amount, transactionTypes, bill_type')
        ->whereBetween(\DB::raw('DATE(created_at)'), [$from, $to])
        ->where('transactionStatus', 'COMPLETED')
        ->whereIn('transactionTypes', ['MT-BILL', 'MT-MOMO', 'MT-BANK', 'MT-AIRTIME'])
        ->groupBy('transactionTypes', 'bill_type')
        ->get();

        $data = array();
        foreach ($transactions as $row){

            if($row["transactionTypes"]=="MT-MOMO"){
                $data["totalMoMoCount"] =  $row["count"];
                $data["totalMoMoAmount"] =  $row["amount"];
            }

            if($row["transactionTypes"]=="MT-BANK"){
                $data["totalBankCount"] =  $row["count"];
                $data["totalBankAmount"] =  $row["amount"];
            }

            if($row["transactionTypes"]=="MT-AIRTIME"){
                $data["totalAirtimeCount"] =  $row["count"];
                $data["totalAirtimeAmount"] =  $row["amount"];
            }

            if($row["transactionTypes"]=="MT-BILL"){
                if($row["bill_type"]=="PREPAID_OFFLINE"){
                    $data["totalOfflineCount"] =  $row["count"];
                    $data["totalOfflineAmount"] =  $row["amount"];
                }
                elseif($row["bill_type"]=="PREPAID_ONLINE"){
                    $data["totalOnlineCount"] =  $row["count"];
                    $data["totalOnlineAmount"] =  $row["amount"];
                }
                elseif($row["bill_type"]=="POSTPAID"){
                    $data["totalPostpaidCount"] =  $row["count"];
                    $data["totalPostpaidAmount"] =  $row["amount"];
                }
                
            }
        }
        return response()->json([
            'message'=>'Dashboard fetch successfully',
            'data'=>$data
        ]);
    }
}
