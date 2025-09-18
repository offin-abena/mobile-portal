@extends('layouts.app')
@section('title', 'Increase Vendor Terminals')
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
    <form method="post" role="form" onsubmit="return confirm('Are you sure you want to perform this transaction');">
        <div class="card card-success card-outline">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <div class="form-group">
                            <label for="vendorId">Select Vendor</label>
                            <select id="vendorId" class="form-control" style="width:100%" name="vendorId">
                                    <option value="" selected="selected">Find Vendor</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-2 mb-md-0">
                        <div class="form-group">
                            <label for="siteId">Select Site/Branch</label>
                            <select id="siteId" class="form-control" name="siteId" style="width:100%">
                                <option value="" selected="selected">Select Branch</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 mb-2 mb-md-0">
                        <div class="form-group">
                            <label for="number">Enter Number of Sites</label>
                            <input type="text" id="number" name="number" class="form-control" style="width:100%">
                        </div>
                    </div>

                    <div class="col-md-2 mb-2 mb-md-0">
                        <div class="form-group">
                            <label for="processBtn">&nbsp;</label>
                            <input type="submit" id="processBtn" class="btn btn-success" name="all_vendors" value="Process"
                                style="width:100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
