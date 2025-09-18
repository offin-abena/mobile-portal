<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KycsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kyc');
    }

    public function manual()
    {
        return view('kyc-manual');
    }

    public function request()
    {
        return view('kyc-request');
    }

    public function approvals()
    {
        return view('kyc-approvals');
    }
    public function unapproved()
    {
        return view('kyc-unapproved');
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
