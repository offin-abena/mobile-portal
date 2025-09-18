@extends('layouts.app')
@section('title', 'Brassica Dashboard')
@section('title', 'Dashboard For Brassica Capita')
@section('content')
<section class="content">
            <div class="row">
    <div class="col-md-8">
        <canvas id="ctx_daily_reg_capita"></canvas>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success text-white"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Investment Clients</span>
                <span class="info-box-number">Yes</span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success text-white"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Partial Clients</span>
                <span class="info-box-number"><b>Yes</b></span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success text-white"><i class="fa fa-bar-chart"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Contributions</span>
                <span class="info-box-number"><b>GHS 1200</b></span>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success text-white"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Redemptions</span>
                <span class="info-box-number"><b>GHS 2000</b></span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="info-box">
            <div class="info-box-content">
                <span class="info-box-number fw-bold" style="font-size: 30px"><strong>GHS 1500</strong></span>
                <span class="info-box-number">All Contributions</span>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="info-box">
            <div class="info-box-content">
                <span class="info-box-number fw-bold" style="font-size: 30px"><strong>GHS 2000</strong></span>
                <span class="info-box-number">Total Revenue</span>
            </div>
        </div>
    </div>
</div>

@endsection
