@extends('layouts.app')
@section('title', 'Monthly Revenue')
@section('sub-title', 'Monthly Revenue Dashboard')
@section('content')
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <canvas id="ctx_monthly_reg"></canvas>
                </div>
            </div>
        </section>
@endsection
