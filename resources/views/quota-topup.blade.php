@extends('layouts.app')
@section('title', 'Quota Topup')
@section('sub-title', 'tGL Offline Quota TopUp')
@section('content')
    <!-- Main content -->
    @include('components.green-bordered-inputs')
       <div class="row">
            <div class="col-md-12">
                <div class="card card-success card-outline shadow-sm">
                    <div class="card-body">
                        <form method="post" role="form" onsubmit="return confirm('Are you sure you want to perform this transaction');">
                             @csrf
                            <div class="form-group">
                                <label for="transaction_id">Transaction Deatails</label>
								<div class="row">
            					<div class="col-md-3">
                                <select name="meteringSystem" class="custom-select" style="width:100%" id="meteringSystem" required>
									<option value="">=====Select Meter Provider======</option>
									<?php
									// Populate Metering System options
									$meteringSystems = array_unique(array_column($meter_data, 'meteringSystem'));
									foreach ($meteringSystems as $system) {
										echo "<option value='$system'>$system</option>";
									}
									?>
								</select>
								</div>
								<div class="col-md-3">
                                <select name="location" id="location" class="custom-select" style="width:100%" id="location" required>
									<option value="">=====Select Location======</option>
                                    <?php
									// Populate Location options
									$locations = array_unique(array_column($meter_data, 'location'));
									foreach ($locations as $location) {
										echo "<option value='$location'>$location</option>";
									}
									?>
								</select>
								</div>
								<div class="col-md-2">
                                <input class="styled-element" placeholder="Enter Amount" type="number" style="width:100%" name="amount" id="amount"  class="form-control">
								</div>
								<div class="col-md-2">
                                <input class="styled-element" placeholder="Confirm Amount" type="number" style="width:100%" name="amount_confirmation" id="amount"  class="form-control">
								</div>
								<div class="col-md-2">
								<input type="submit" class="styled-element styled-button" style="width:100%" class="btn btn-success" name="purchase_quota" value="Purchase Quota">
								</div>
								</div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
		  </div>
		<div class="row">
            <div class="col-md-12">
                    <div class="card card-success card-outline shadow-sm">
                        <!-- List of All Payout -->
                        <div class="card-header">Transaction Response Details</div>
                        <div class="card-body">

								<div class="row">
            					<div class="col-md-4">
								<label for="transaction_id">Credit Amount</label>
                                <input class="styled-element" type="text" style="width:100%" value="{{ $payload['creditAmount'] ?? null }}" name="transaction_id" id="transaction_id"  class="form-control" readonly>
								</div>

								<div class="col-md-4">
								<label for="transaction_id">Commission</label>
                                <input class="styled-element" value=""  type="text" value="{{ $payload['commission'] ?? null }}" style="width:100%" name="transaction_id" id="transaction_id"  class="form-control" readonly>
								</div>

								<div class="col-md-4">
								<label for="transaction_id">New Balance</label>
                                <input class="styled-element" value=""  type="text" value="{{ $payload['newBalance'] ?? null }}" style="width:100%" name="transaction_id" id="transaction_id"  class="form-control" readonly>
								</div>

							</div>

							<div class="row">
            					<div class="col-md-4">
								<label for="transaction_id">Vendor Name</label>
                                <input class="styled-element" value="{{ $payload['vendorName'] ?? null }}"  type="text" style="width:100%" name="transaction_id" id="transaction_id"  class="form-control" readonly>
								</div>

								<div class="col-md-4">
								<label for="transaction_id">Receipt Number</label>
                                <input class="styled-element" value="{{ $payload['receiptNo'] ?? null }}"  type="text" style="width:100%" name="transaction_id" id="transaction_id"  class="form-control" readonly>
								</div>

								<div class="col-md-4">
								<label for="transaction_id">Request ID</label>
                                <input class="styled-element" value="{{ $payload['requestId'] ?? null }}" type="text" style="width:100%" name="transaction_id" id="transaction_id"  class="form-control" readonly>
								</div>

							</div>


                            <hr>
                        </div>
                    </div>
                </div>
        </div>
@endsection
