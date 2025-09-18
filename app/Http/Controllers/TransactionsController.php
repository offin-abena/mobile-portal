<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('filtered-transactions');
    }

    public function failedToWrite()
    {
        return view('failed-transactions');
    }

    public function postpaid(){


        if(request()->isMethod('post')){

            return redirect()->back()->withInput();
        }
        return view('postpaid-transactions');
    }

    public function refunded(){
        return view('refunded-transactions');
    }

    public function flagged(){
        return view('flagged-transactions');
    }

    public function investment(){
        return view('transactions-capital');
    }

    public function bog_monthly_report(){
        return view('bog-monthly-report');
    }

    public function monthly_revenue(){
        return view('monthly-revenue');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
