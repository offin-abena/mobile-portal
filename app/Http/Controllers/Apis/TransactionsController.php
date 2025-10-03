<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintransaction;
use Carbon\Carbon;
use App\Models\ViewMainTransaction;

class TransactionsController extends Controller
{

    public function refundedTransactions(Request $request){
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = ViewMainTransaction::select([
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
                    'remitRecipientMomoName',
                    'airtimeNumber',
                    'remitRecipientBankName',
                    'remitRecipientBankAccount',
                    'remitRecipientBankAccountName',
                    'b_bus_collection_id',
                    'async_id',
                    'app_version',
                ])
                ->where('transactionStatus','REFUND');

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($d_from,$d_to) {
                $q->whereBetween('created_at',[$d_from,$d_to]);
            });
        }

        if ($search) {
            $query = $query->where(function ($q) use ($search) {
                $q->where('customer', 'like', "%{$search}%")
                ->orWhere('b_bus_id', 'like', "%{$search}%")
                ->orWhere('transaction_uid', 'like', "%{$search}%")
                ->orWhere('transaction_type', 'like', "%{$search}%")
                //->orWhere('transactionStatus', 'like', "%{$search}%")
                ->orWhere('purpose', 'like', "%{$search}%")
                ->orWhere('sendersAmount', 'like', "%{$search}%")
                ->orWhere('fee', 'like', "%{$search}%")
                ->orWhere('billCode', 'like', "%{$search}%")
                ->orWhere('bill_type', 'like', "%{$search}%")
                ->orWhere('remitRecipientMomoName', 'like', "%{$search}%")
                ->orWhere('airtimeNumber', 'like', "%{$search}%")
                ->orWhere('remitRecipientBankName', 'like', "%{$search}%")
                ->orWhere('remitRecipientBankAccount', 'like', "%{$search}%")
                ->orWhere('remitRecipientBankAccountName', 'like', "%{$search}%")
                ->orWhere('b_bus_collection_id', 'like', "%{$search}%")
                ->orWhere('async_id', 'like', "%{$search}%")
                ->orWhere('app_version', 'like', "%{$search}%");
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
    public function refundCandidates(Request $request){
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = ViewMainTransaction::select([
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
                    'remitRecipientMomoName',
                    'airtimeNumber',
                    'remitRecipientBankName',
                    'remitRecipientBankAccount',
                    'remitRecipientBankAccountName',
                    'b_bus_collection_id',
                    'async_id',
                    'app_version',
                ])
                ->whereIn('transactionStatus',['PROCESSING','WAITING']);

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($d_from,$d_to) {
                $q->whereBetween('created_at',[$d_from,$d_to]);
            });
        }

        if ($search) {
            $query = $query->where(function ($q) use ($search) {
                $q->where('customer', 'like', "%{$search}%")
                ->orWhere('b_bus_id', 'like', "%{$search}%")
                ->orWhere('transaction_uid', 'like', "%{$search}%")
                ->orWhere('transaction_type', 'like', "%{$search}%")
                //->orWhere('transactionStatus', 'like', "%{$search}%")
                ->orWhere('purpose', 'like', "%{$search}%")
                ->orWhere('sendersAmount', 'like', "%{$search}%")
                ->orWhere('fee', 'like', "%{$search}%")
                ->orWhere('billCode', 'like', "%{$search}%")
                ->orWhere('bill_type', 'like', "%{$search}%")
                ->orWhere('remitRecipientMomoName', 'like', "%{$search}%")
                ->orWhere('airtimeNumber', 'like', "%{$search}%")
                ->orWhere('remitRecipientBankName', 'like', "%{$search}%")
                ->orWhere('remitRecipientBankAccount', 'like', "%{$search}%")
                ->orWhere('remitRecipientBankAccountName', 'like', "%{$search}%")
                ->orWhere('b_bus_collection_id', 'like', "%{$search}%")
                ->orWhere('async_id', 'like', "%{$search}%")
                ->orWhere('app_version', 'like', "%{$search}%");
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
    public function failedToWrite(Request $request)
    {
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = Maintransaction::whereNot('write_status',1)->select([
            'created_at',
            'w_sender_name',
            'foreignId',
            'transaction_uid',
            'transactionTypes',
            'transactionStatus',
            'purpose',
            'sendersAmount',
            'fee',
            'billCode',
            'async_id',
            'bill_type',
            'airtimeNumber',
            'remitRecipientMomoName',
            'remitRecipientMomoName',
            'remitRecipientBankName',
            'remitRecipientBankAccount',
            'remitRecipientBankAccountName',
            'write_status'
        ]);

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search) {
                $q->whereBetween('created_at',[$d_from,$d_to]);
            });
        }

        if($search){
            $query=$query->where(function ($q) use ($search) {
                $q->where('w_sender_name', 'like', "%{$search}%")
                  ->orWhere('foreignId', 'like', "%{$search}%")
                  ->orWhere('transaction_uid', 'like', "%{$search}%")
                  ->orWhere('transactionTypes', 'like', "%{$search}%")
                  ->orWhere('transactionStatus', 'like', "%{$search}%")
                  ->orWhere('purpose', 'like', "%{$search}%")
                  ->orWhere('sendersAmount', 'like', "%{$search}%")
                  ->orWhere('fee', 'like', "%{$search}%")
                  ->orWhere('billCode', 'like', "%{$search}%")
                  ->orWhere('async_id', 'like', "%{$search}%")
                  ->orWhere('bill_type', 'like', "%{$search}%")
                  ->orWhere('airtimeNumber', 'like', "%{$search}%")
                  ->orWhere('remitRecipientMomoName', 'like', "%{$search}%")
                  ->orWhere('remitRecipientBankName', 'like', "%{$search}%")
                  ->orWhere('remitRecipientBankAccount', 'like', "%{$search}%")
                  ->orWhere('remitRecipientBankAccountName', 'like', "%{$search}%")
                  ->orWhere('write_status', 'like', "%{$search}%");
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
        $transactions = $query
            ->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $transactions,
        ]);
   }
   public function index(Request $request)
   {
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search
        $trnx_Type = $request->input('trnx_Type'); // global search
        $sender_id = $request->input('sender_id'); // global search

        // Base query
        $query = Maintransaction::whereNot('write_status',1)->select([
            'created_at',
            'w_sender_name',
            'foreignId',
            'transaction_uid',
            'transactionTypes',
            'transactionStatus',
            'purpose',
            'sendersAmount',
            'fee',
            'billCode',
            'async_id',
            'bill_type',
            'airtimeNumber',
            'remitRecipientMomoNumber',
            'remitRecipientMomoName',
            'remitRecipientBankName',
            'remitRecipientBankAccount',
            'remitRecipientBankAccountName',
            'write_status'
        ]);


        if(!empty($sender_id)){
            $query=$query->where('senderID',$sender_id);
        }


        $recordsTotal = $query->count();

        //dd($d_from,$d_to,$trnx_Type);

        // Filtering
        if (!empty($d_from) && !empty($d_to) && !empty($trnx_Type)) {
            $query=$query->where(function ($q) use ($search,$d_from,$d_to,$trnx_Type) {
                $q->whereBetween('created_at', [Carbon::parse($d_from)->startOfDay(),Carbon::parse($d_to)->endOfDay()]);
                $q->where('transaction_type',$trnx_Type);
            });
        }


        if($search){
            $query=$query->where(function ($q) use ($search) {
                $q->where('w_sender_name', 'like', "%{$search}%")
                  ->orWhere('foreignId', 'like', "%{$search}%")
                  ->orWhere('transaction_uid', 'like', "%{$search}%")
                  ->orWhere('transactionTypes', 'like', "%{$search}%")
                  ->orWhere('transactionStatus', 'like', "%{$search}%")
                  ->orWhere('purpose', 'like', "%{$search}%")
                  ->orWhere('sendersAmount', 'like', "%{$search}%")
                  ->orWhere('fee', 'like', "%{$search}%")
                  ->orWhere('billCode', 'like', "%{$search}%")
                  ->orWhere('async_id', 'like', "%{$search}%")
                  ->orWhere('bill_type', 'like', "%{$search}%")
                  ->orWhere('airtimeNumber', 'like', "%{$search}%")
                  ->orWhere('remitRecipientMomoName', 'like', "%{$search}%")
                  ->orWhere('remitRecipientBankName', 'like', "%{$search}%")
                  ->orWhere('remitRecipientBankAccount', 'like', "%{$search}%")
                  ->orWhere('remitRecipientBankAccountName', 'like', "%{$search}%")
                  ->orWhere('write_status', 'like', "%{$search}%");
            });
        }

        if($request->has('order')) {
            $orderColumnIndex = $request->input('order.0.column');   // index of column
            $orderDir = $request->input('order.0.dir', 'asc');      // direction: asc or desc
            $orderColumn = $request->input("columns.$orderColumnIndex.data"); // column name from DataTables

            if (!empty($orderColumn)) {
                $query->orderBy($orderColumn, $orderDir);
            }
        }


        $recordsFiltered = $query->count();

        // Pagination + ordering
        $transactions = $query
            ->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length);

        //dd($transactions->toSql());

        $transactions=$transactions->get();


        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $transactions,
        ]);
   }

   public function monthly_revenue(Request $request){
        //This is for the Dashboard
        // Required DataTables params
        $d_from = $request->input('d_from');
        $d_to = $request->input('d_to');

        $query = Maintransaction::query()
        ->selectRaw('sum(fee) AS Num,sum(sendersAmount) AS Num2,COUNT(*) as Num3, MONTH(created_at) AS Month, YEAR(created_at) AS Year')
        ->where('transactionStatus','COMPLETED')
        ->where('transactionTypes','!=','MT-PULL')
        ->groupByRaw('DATE(created_at),MONTH(created_at),YEAR(created_at)');
        //->get();

        if(!empty($d_from) && !empty($d_to)){
            $query->whereBetween('created_at',[$d_from,$d_to]);
        }

        $transactions=$query->get();
        // Return response in DataTables format
        return response()->json([
            'message' => 'Monthly revenue report',
            'data' => $transactions,
        ]);
   }
   public function forensics(Request $request){
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search

        // Base query
        $query = Maintransaction::select([
            'created_at',
            'w_sender_name',
            'foreignId',
            'transaction_uid',
            'transactionTypes',
            'transactionStatus',
            'purpose',
            'sendersAmount',
            'fee',
            'billCode',
            'async_id',
            'bill_type',
            'airtimeNumber',
            'remitRecipientMomoName',
            'remitRecipientMomoName',
            'remitRecipientBankName',
            'remitRecipientBankAccount',
            'remitRecipientBankAccountName',
            'write_status'
        ]);

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search) {
                $q->whereBetween('created_at',[$d_from,$d_to]);
            });
        }

        if($search){
            $query=$query->where(function ($q) use ($search) {
                $q->where('w_sender_name', 'like', "%{$search}%")
                  ->orWhere('foreignId', 'like', "%{$search}%")
                  ->orWhere('transaction_uid', 'like', "%{$search}%")
                  ->orWhere('transactionTypes', 'like', "%{$search}%")
                  ->orWhere('transactionStatus', 'like', "%{$search}%")
                  ->orWhere('purpose', 'like', "%{$search}%")
                  ->orWhere('sendersAmount', 'like', "%{$search}%")
                  ->orWhere('fee', 'like', "%{$search}%")
                  ->orWhere('billCode', 'like', "%{$search}%")
                  ->orWhere('async_id', 'like', "%{$search}%")
                  ->orWhere('bill_type', 'like', "%{$search}%")
                  ->orWhere('airtimeNumber', 'like', "%{$search}%")
                  ->orWhere('remitRecipientMomoName', 'like', "%{$search}%")
                  ->orWhere('remitRecipientBankName', 'like', "%{$search}%")
                  ->orWhere('remitRecipientBankAccount', 'like', "%{$search}%")
                  ->orWhere('remitRecipientBankAccountName', 'like', "%{$search}%")
                  ->orWhere('write_status', 'like', "%{$search}%");
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
        $transactions = $query
            ->orderBy('created_at', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $transactions,
        ]);
    }

    public function bog_monthly_report(Request $request){
        //\DB::enableQueryLog();
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search
        $trnx_Type = $request->input('trnx_Type'); // global search

        // Base query
        $query = Maintransaction::selectRaw('
                    sd.fullName,
                    sd.phoneNum,
                    sd.gender,
                    sd.dob,
                    sd.nationality,
                    sd.postcode,
                    sd.addressLine1,
                    sd.region,
                    sd.idType,
                    sd.idNumber,
                    senderID,recipientID, foreignId,transaction_uid,transactionTypes,transactionStatus,purpose,fee,billCode,bill_type,airtimeNumber,remitRecipientMomoName,remitRecipientMomoNumber,remitRecipientBankName,remitRecipientBankAccount,remitRecipientBankAccountName,async_id,app_version,dateTime,sendersAmount')
        ->join('customer_tbl as sd','sd.id','=','maintransaction_tbl.senderID')
        ->where('transactionTypes',$trnx_Type)
        ->where('transactionStatus','COMPLETED');
        //->whereBetween('DATE(created_at)',[$d_from,$d_to]);

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search,$d_from,$d_to) {
                $q->whereBetween(\DB::raw('DATE(dateTime)'),[$d_from,$d_to]);
            });
        }

        if($search){
            $query = $query->where(function ($q) use ($search) {
                        $q->where('senderID', 'like', "%{$search}%")
                        ->orWhere('recipientID', 'like', "%{$search}%")
                        ->orWhere('foreignId', 'like', "%{$search}%")
                        ->orWhere('transaction_uid', 'like', "%{$search}%")
                        ->orWhere('transactionTypes', 'like', "%{$search}%")
                        ->orWhere('transactionStatus', 'like', "%{$search}%")
                        ->orWhere('purpose', 'like', "%{$search}%")
                        ->orWhere('fee', 'like', "%{$search}%")
                        ->orWhere('billCode', 'like', "%{$search}%")
                        ->orWhere('bill_type', 'like', "%{$search}%")
                        ->orWhere('airtimeNumber', 'like', "%{$search}%")
                        ->orWhere('remitRecipientMomoName', 'like', "%{$search}%")
                        ->orWhere('remitRecipientMomoNumber', 'like', "%{$search}%")
                        ->orWhere('remitRecipientBankName', 'like', "%{$search}%")
                        ->orWhere('remitRecipientBankAccount', 'like', "%{$search}%")
                        ->orWhere('remitRecipientBankAccountName', 'like', "%{$search}%")
                        ->orWhere('async_id', 'like', "%{$search}%")
                        ->orWhere('app_version', 'like', "%{$search}%")
                        ->orWhere('dateTime', 'like', "%{$search}%")
                        ->orWhere('sendersAmount', 'like', "%{$search}%"); // alias "total"
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
        $transactions = $query
            ->orderBy('dateTime', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        //dd(\DB::getQueryLog());

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $transactions,
        ]);
    }

    public function flagged_transactions(Request $request){
        //\DB::enableQueryLog();
        // Required DataTables params
        $draw   = $request->input('draw');
        $start  = $request->input('start',null);   // offset
        $length = $request->input('length',2000);  // page size
        $search = $request->input('search.value'); // global search
        $d_from = $request->input('d_from'); // global search
        $d_to = $request->input('d_to'); // global search
        //$trnx_Type = $request->input('trnx_Type'); // global search

        // Base query
        $query = Maintransaction::selectRaw('
                    sd.fullName,
                    sd.phoneNum,
                    sd.gender,
                    sd.dob,
                    sd.nationality,
                    sd.postcode,
                    sd.addressLine1,
                    sd.region,
                    sd.idType,
                    sd.idNumber,
                    senderID,recipientID, foreignId,transaction_uid,transactionTypes,transactionStatus,purpose,fee,billCode,bill_type,airtimeNumber,remitRecipientMomoName,remitRecipientMomoNumber,remitRecipientBankName,remitRecipientBankAccount,remitRecipientBankAccountName,async_id,app_version,dateTime,sendersAmount')
        ->join('customer_tbl as sd','sd.id','=','maintransaction_tbl.senderID');
        //->where('transactionTypes',$trnx_Type)
        //->where('transactionStatus','COMPLETED');
        //->whereBetween('DATE(created_at)',[$d_from,$d_to]);

        $recordsTotal = $query->count();

        // Filtering
        if (!empty($d_from) && !empty($d_to)) {
            $query=$query->where(function ($q) use ($search,$d_from,$d_to) {
                $q->whereBetween(\DB::raw('DATE(dateTime)'),[$d_from,$d_to]);
            });
        }

        if($search){
            $query = $query->where(function ($q) use ($search) {
                        $q->where('senderID', 'like', "%{$search}%")
                        ->orWhere('recipientID', 'like', "%{$search}%")
                        ->orWhere('foreignId', 'like', "%{$search}%")
                        ->orWhere('transaction_uid', 'like', "%{$search}%")
                        ->orWhere('transactionTypes', 'like', "%{$search}%")
                        ->orWhere('transactionStatus', 'like', "%{$search}%")
                        ->orWhere('purpose', 'like', "%{$search}%")
                        ->orWhere('fee', 'like', "%{$search}%")
                        ->orWhere('billCode', 'like', "%{$search}%")
                        ->orWhere('bill_type', 'like', "%{$search}%")
                        ->orWhere('airtimeNumber', 'like', "%{$search}%")
                        ->orWhere('remitRecipientMomoName', 'like', "%{$search}%")
                        ->orWhere('remitRecipientMomoNumber', 'like', "%{$search}%")
                        ->orWhere('remitRecipientBankName', 'like', "%{$search}%")
                        ->orWhere('remitRecipientBankAccount', 'like', "%{$search}%")
                        ->orWhere('remitRecipientBankAccountName', 'like', "%{$search}%")
                        ->orWhere('async_id', 'like', "%{$search}%")
                        ->orWhere('app_version', 'like', "%{$search}%")
                        ->orWhere('dateTime', 'like', "%{$search}%")
                        ->orWhere('sendersAmount', 'like', "%{$search}%"); // alias "total"
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
        $transactions = $query
            ->orderBy('dateTime', 'desc')
            ->skip($start)
            ->take($length)
            ->get();

        //dd(\DB::getQueryLog());

        // Return response in DataTables format
        return response()->json([
            'draw' => intval($draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $transactions,
        ]);
    }
}
