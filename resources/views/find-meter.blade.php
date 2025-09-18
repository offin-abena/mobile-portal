@extends('layouts.app')
@section('title', 'Find Meter')
@section('sub-title', 'Polymorph Meter Profile')

@section('content')
@include('components.green-bordered-inputs')
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card card-success card-outline">
                <!--<div class="box-header with-border">Perform Transaction.</div>-->
                <div class="card-body">
                    <form method="post" role="form"  action="{{ route('meters.find') }}">
                        @csrf
                        <div class="form-group">
                            <label for="transaction_id">Enter Meter Number</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <input class="styled-element" type="text" style="width:100%" value="{{ old('transaction_id') }}" name="transaction_id" id="transaction_id"  required>
                                </div>
                                <div class="col-md-5">
                                    <select class="custom-select" name="category" style="width:100%" required>
                                        <option value="prepaid" {{ old('category')=='prepaid'?'Selected':'' }}>Prepaid</option>
                                        <option value="postpaid" {{ old('category')=='postpaid'?'Selected':'' }}>Postpaid</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="styled-element styled-button" style="width:100%" class="btn btn-success" name="polymorph_meter" value="Get Meter Info">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@if (request()->get('transaction_id') && request()->get('category'))
 <div class="row">
        <div class="col-md-12">
            <div class="card card-success card-outline shadow-sm">
                <!-- List of All Payout -->
                <div class="card-header">
                    <h3 class="card-title">Polymorph Info</h3>
                </div>
                <div class="card-body">

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="transaction_id">Meter Number</label>
                            <input class="styled-element" type="text" style="width:100%" value="{{ $payload['PayLoad']['MeterNumber'] ?? null }}"
                                name="transaction_id" id="transaction_id" class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="transaction_id">Account Number</label>
                            <input class="styled-element" value="{{ $payload['PayLoad']['AccountNumber'] ?? null }}" type="text" style="width:100%"
                                name="transaction_id" id="transaction_id" class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="transaction_id">SPN</label>
                            <input class="styled-element" value="{{ $payload['PayLoad']['SPN'] ?? null }}" type="text" style="width:100%"
                                name="transaction_id" id="transaction_id" class="form-control" readonly>
                        </div>

                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="transaction_id">Meter Provider</label>
                            <input class="styled-element" value="{{ $payload['PayLoad']['MeterProvider'] ?? null}}" type="text"
                                style="width:100%" name="transaction_id" id="transaction_id" class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="transaction_id">District</label>
                            <input class="styled-element" value="{{ $payload['PolymorphData']['districtName'] ?? null }}" type="text" style="width:100%"
                                name="transaction_id" id="transaction_id" class="form-control" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="transaction_id">Region</label>
                            <input class="styled-element" value="{{ $payload['PolymorphData']['districtName'] ?? null }}" type="text" style="width:100%"
                                name="transaction_id" id="transaction_id" class="form-control" readonly>
                        </div>

                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="transaction_id">Customer's Name</label>
                            <input class="styled-element" value="{{ $payload['PolymorphData']['customer']['fullName'] ?? null }}" type="text" style="width:100%"
                                name="transaction_id" id="transaction_id" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label for="transaction_id">Customer's Contact</label>
                            <input class="styled-element" value="{{ $payload['PolymorphData']['customer']['phoneNumber'] ?? null }}" type="text"
                                style="width:100%" name="transaction_id" id="transaction_id" class="form-control"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label for="transaction_id">Customer's Address</label>
                            <input class="styled-element" value="{{ $payload['PolymorphData']['property']['address'] ?? null }}" type="text" style="width:100%"
                                name="transaction_id" id="transaction_id" class="form-control" required>
                        </div>

                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="transaction_id">Geo Code</label>
                            <input class="styled-element" value="{{ $payload['PolymorphData']['geoCode'] ?? null }}" type="text" style="width:100%"
                                name="transaction_id" id="transaction_id" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label for="transaction_id">Tariff Class</label>
                            <input class="styled-element" value="{{ $payload['PolymorphData']['tariffClassName'] ?? null}}" type="text" style="width:100%"
                                name="transaction_id" id="transaction_id" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label for="transaction_id">Meter Status</label>
                            <input class="styled-element" value="{{ $payload['PolymorphData']['status'] ?? null }}" type="text" style="width:100%"
                                name="transaction_id" id="transaction_id" class="form-control" required>
                        </div>

                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection
