@extends('layouts.app')
@section('title', 'Increase Vendor Terminals')
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script type="text/javascript">

    function loadVendor(){
        const url="{{ route('api.vendors.tgl.search') }}";
        //console.log('Url',url)
        $.ajax({
                url:url,   // your endpoint
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // clear existing
                    $('#vendorId').empty();

                    // add default option
                    $('#vendorId').append('<option value="">Select Vendor</option>');

                    // populate from response
                    $.each(data.data, function (i, item) {
                        $('#vendorId').append(
                            $('<option>', { value: item.id, text: item.name })
                        );
                    });

                    // now initialize select2 once
                    $('#vendorId').select2({
                        placeholder: "Select Vendor",
                        allowClear: true
                    });
                }
            })
    }
    $(document).ready(function() {
        loadVendor();

        $('#frmIncreaseVendorTerminal').submit(function(evt){
            evt.preventDefault();
            const url="{{ route('api.terminals.process') }}";
            $.get(url)
                .done(function(data) {
                    $('.alert-dismissible').hide();
                    $('#alertSuccess').text(response.message);
                    $('#alertSuccess').show();
                })
                .fail(function(xhr, status, error) {
                    $('.alert-dismissible').hide();

                    let errorHtml = '<div class="alert alert-danger"><ul>';

                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        // Laravel validation error
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                    } else if (xhr.status === 400) {
                        // Bad request
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorHtml += '<li>' + xhr.responseJSON.message + '</li>';
                        } else {
                            errorHtml += '<li>Bad request. Please check your input.</li>';
                        }
                    } else {
                        // General / server error
                        errorHtml += '<li>An unexpected error occurred. Please try again later.</li>';
                    }

                    errorHtml += '</ul></div>';
                    $('#alertWarning').html(errorHtml).show();
                })
        })
    });

        $('#vendorId').on('select2:select', function (e) {
            //showLoader();
             console.log('Vendor',$('#vendorId').val())
            // Simulate AJAX (2s)
            //setTimeout(() => {
              const siteId = document.getElementById('siteId');

              siteId.innerHTML = '<option value="" selected="selected">Select Branch</option>';
               loadBranches($('#vendorId').val())
                //hideLoader();
            //}, 200);
        });

        function loadBranches(vendorId){
            const url=`/api/vendors/${vendorId}/branches`

            $.get(url)
                .done(function(data) {
                    const sites=data.data;
                    const siteId = document.getElementById('siteId');

                    //siteId.innerHTML = '<option value="" selected="selected">Select Branch</option>';

                    sites.forEach(branch => {
                        const option = document.createElement('option');
                        option.value = branch.id;   // your branch id
                        option.textContent = branch.name; // your branch name
                        siteId.appendChild(option);
                    });
                })
                .fail(function(xhr, status, error) {
                    $('.alert-dismissible').hide();

                    let errorHtml = '<div class="alert alert-danger"><ul>';

                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        // Laravel validation error
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                    } else if (xhr.status === 400) {
                        // Bad request
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorHtml += '<li>' + xhr.responseJSON.message + '</li>';
                        } else {
                            errorHtml += '<li>Bad request. Please check your input.</li>';
                        }
                    } else {
                        // General / server error
                        errorHtml += '<li>An unexpected error occurred. Please try again later.</li>';
                    }

                    errorHtml += '</ul></div>';
                    $('#alertWarning').html(errorHtml).show();
                })
        }
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
    {{-- <div id="global-loader">
        <i class="fa fa-spinner fa-spin fa-4x" style="color:white;"></i>
    </div> --}}
    <form id="frmIncreaseVendorTerminal" method="post" role="form" action="{{ route('api.terminals.process') }}" onsubmit="return confirm('Are you sure you want to perform this transaction');">
        @csrf
        <div class="card card-success card-outline">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <div class="form-group">
                            <label for="vendorId">Select Vendor</label>
                            <select id="vendorId" class="form-control" required style="width:100%" name="vendorId">
                                    <option value="" selected="selected">Find Vendor</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 mb-2 mb-md-0">
                        <div class="form-group">
                            <label for="siteId">Select Site/Branch</label>
                            <select id="siteId" class="form-control" name="siteId" required style="width:100%">
                                <option value="" selected="selected">Select Branch</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 mb-2 mb-md-0">
                        <div class="form-group">
                            <label for="number">Enter Number of Sites</label>
                            <input type="text" id="number" required name="number" class="form-control" style="width:100%">
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
