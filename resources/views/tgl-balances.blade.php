@extends('layouts.app')
@section('title', 'TGL Balances')
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#vendorId').select2({
                placeholder: 'Search vendor...',
                ajax: {
                url: "{{ route('api.vendors.search') }}",   // your backend endpoint
                dataType: 'json',
                delay: 250,          // wait time after typing
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data.map(function (item) {
                            return {
                                id: item.id,         // select2 value
                                text: item.vendorName      // select2 display text
                            };
                        })
                    };
                },
                cache: true
                },
                minimumInputLength: 2
        });
    });
</script>
@endsection
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 40px !important;
        line-height: 40px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
    }
</style>
@endsection

@section('content')
@include('components.green-bordered-inputs')
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-body">
                <form method="post" role="form" onsubmit="return confirm('Are you sure you want to perform this transaction');" action="{{ route('balances.tgl') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vendorId">Select Vendor</label>
                                <select id="vendorId" class="form-control" style="width:100%" name="vendorId">
                                    <option value="" selected="selected">Find Vendor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="transaction_id"> &nbsp;</label>
                                <input type="submit" style="width:100%" class="btn btn-success"
                                    name="GET_vendors_DETAILS" value="Get Vendor Account Details">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if ($request->get('GET_vendors_DETAILS'))
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">TGL Balance Summary</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_balance_purchased">Total Balance Purchased</label>
                            <input class="styled-element" value="<?= 'N/A' ?>" type="text" style="width:100%"
                                name="total_balance_purchased" id="total_balance_purchased" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_balance_spent">Total Balance Spent</label>
                            <input class="styled-element" value="<?= 'N/A' ?>" type="text" style="width:100%"
                                name="total_balance_spent" id="total_balance_spent" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="current_balance">Current Balance</label>
                            <input class="styled-element"
                                value="{{ isset($payload['balance']['remainingQuota'])? number_format($payload['balance']['remainingQuota'], 2, '.', ',') : 'N/A' }}"
                                type="text" style="width:100%" name="transaction_id" id="current_balance"
                                class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">Vendor Commission Summary</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_net_commission">Total Net Commission</label>
                            <input class="styled-element"
                                value="{{ isset($payload['commission']['totalCommission']) ? number_format($payload['commission']['totalNetCommission'], 2, '.', ',') : 'N/A' }}"
                                type="text" style="width:100%" name="total_net_commission" id="total_net_commission"
                                class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_redeemed_commission">Total Redeemed Commission</label>
                            <input class="styled-element"
                                value="{{ isset($payload['commission']['redeemedNetCommission']) ? number_format($payload['commission']['redeemedNetCommission'], 2, '.', ',') : 'N/A' }}"
                                type="text" style="width:100%" name="total_redeemed_commission" id="total_redeemed_commission"
                                class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="total_outstanding_commission">Total Outstanding Commission</label>
                            <input class="styled-element"
                                value="{{ isset($payload['commission']['outstandingNetCommission']) ? number_format($payload['commission']['outstandingNetCommission'], 2, '.', ',') : 'N/A' }}"
                                type="text" style="width:100%" name="total_outstanding_commission" id="total_outstanding_commission"
                                class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
</section>
<!-- /.content -->
@endsection

