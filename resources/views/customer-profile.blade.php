@extends('layouts.app')
@section('title', 'Customer Profile')
{{-- @section('sub-title', 'Customers List') --}}
@section('content')
    <div class="content-header">
        <div class="container-fluid" style="padding-left: 0px;">
            <div class="row mb-2">
                <div class="col-12">
                    <h1 class="h3 mb-0" style="font-size: 1.5rem">
                        <span class="text-aqua text-sm">Registered On: 2025-09-24 13:58:44</span> |
                        <span class="text-aqua text-sm">Account Type: INDIVIDUAL</span> |
                        <span class="text-aqua text-sm">Country: GH</span> |
                        <span class="text-aqua text-sm">Last Login: 2025-09-24 14:02:51</span> |
                        <span class="text-aqua text-sm">Last Trnx Date: 2025-09-24 14:02:51</span>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="small-box text-bg-info text-white">
                    <div class="inner">
                        <h3><span id="phoneNum">0.00</span></h3>

                        <p>Phone Number</p>
                    </div>
                    <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" width="100" height="100"
                        fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547
                                                             2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0
                                                             .644.178l2.189-.547c.52-.13 1.071-.014 1.494.315l2.306
                                                             1.794c.829.645.905 1.87.163 2.61l-1.034
                                                             1.034c-.74.74-1.846 1.065-2.877.702a18.634
                                                             18.634 0 0 1-7.01-4.42A18.634 18.634 0 0
                                                             1 .649 3.388c-.362-1.03-.037-2.137.703-2.877z" />
                    </svg>
                </div>



            </div>
            <div class="col-md-4">
                <div class="small-box text-bg-info text-white">
                    <div class="inner">
                        <h3><span id="fullName">0.00</span></h3>

                        <p>Customer Name</p>
                    </div>
                    <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"
                        style="width:95px;height:95px;top: 10px;">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        <path fill-rule="evenodd" d="M14 14s-1 0-1-1-1-4-5-4-5 3-5
                                                 4-1 1-1 1h12z" />
                    </svg>
                </div>
                <div class="info-box">
                    <span class="info-box-icon bg-danger text-white"><i class="fa fa-cart-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Debited Amount</span>
                        <span class="info-box-number">GHS <span id="debit">0.00</span></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box text-bg-success text-white">
                    <div class="inner">
                        <h3>GHC <span id="balance">0.00</span></h3>

                        <p>Virtual Balance.</p>
                    </div>
                    <svg class="small-box-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"
                        style="width:95px;height:95px;top: 10px;">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        <path fill-rule="evenodd" d="M14 14s-1 0-1-1-1-4-5-4-5 3-5
                                                 4-1 1-1 1h12z" />
                    </svg>
                </div>

                <div class="info-box">
                    <span class="info-box-icon bg-danger text-white"><i class="fa fa-cart-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Credited Amount</span>
                        <span class="info-box-number">GHS <span id="credit">0.00</span></span>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Customer Profile</h3>
                    </div>
                    <div class="card-body">
                        <form id="frmCustomer" method="post" role="form" action="#">
                            @csrf
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" required name="fullName" readonly id="fullName2" class="form-control"
                                    value="Gebu Eyram">
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <input type="text" name="gender" id="gender" readonly class="form-control"
                                    value="MALE">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" readonly class="form-control"
                                    value="" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="idType" class="form-label">ID Type</label>
                                <input type="text" name="idType" id="idType" readonly class="form-control"
                                    value="GHCARD" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="idNumber" class="form-label">ID Number</label>
                                <input type="text" name="idNumber" id="idNumber" readonly class="form-control"
                                    value="" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="dob" class="form-label">Birth Date</label>
                                <input type="text" name="dob" id="dob" readonly class="form-control"
                                    value="" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value=""
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label for="postCode" class="form-label">Post Code</label>
                                <input type="text" name="postCode" id="postCode" class="form-control"
                                    value="" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="accountType" class="form-label">Account Type</label>
                                <select class="form-select" name="accountType" required id="accountType">
                                    <option value="1">INDIVIDUAL</option>
                                    <option value="2">SYSTEM</option>
                                    <option value="3">AGENT</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" required id="status">
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">Inactive</option>
                                    <option value="SUSPENDED">Suspended</option>
                                </select>
                            </div>

                            <button type="submit" name="update_cus" class="btn btn-primary">
                                Update Info
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-9 mt-3 mt-md-0">
                <div class="card card-danger card-outline">
                    <div class="card-header">
                        Customer Transactions
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="single-maintransaction-sender-list"
                                class="table table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>Trnx Date</th>
                                        <th>Transaction ID</th>
                                        <th>Trnx Type</th>
                                        <th>Status</th>
                                        <th>Purpose</th>
                                        <th>Amount</th>
                                        <th>Fee</th>
                                        <th>Bill Reference</th>
                                        <th>Bill Type</th>
                                        <th>Airtime Number</th>
                                        <th>MoMo Name</th>
                                        <th>MoMo Number</th>
                                        <th>Bank Name</th>
                                        <th>Bank Account #</th>
                                        <th>Bank Account Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated by DataTables -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>


@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- JS Dependencies for Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>

    <!-- Export functionality -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Buttons for HTML5 export + print -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function(evt) {
            $('#single-maintransaction-sender-list').DataTable({
                "ordering": true, // enable column sorting
                "searching": true, // enable search box
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('api.transactions.index') }}", // your backend endpoint here
                    "type": "GET", // or POST if your API expects it
                    "dataSrc": "data", // adjust based on your API JSON structure,
                    "data": function(d) {
                        d.sender_id = "{{ Route::current()->parameter('profile') }}";
                    }
                },
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "order": [
                    [0, "desc"]
                ],
                "lengthMenu": [10, 25, 100, 100000],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search transactions..."
                },
                responsive: true,
                lengthMenu: [10, 100, 200, 500, 1000, 2000],
                dom: '<"row mb-3"<"col-md-4"l><"col-md-4"f><"col-md-4 text-end"B>>rtip',
                "columns": [{
                        data: "created_at",
                        title: "Trnx Date"
                    },
                    {
                        data: "transaction_uid",
                        title: "Transaction ID"
                    },
                    {
                        data: "transactionTypes",
                        title: "Trnx Type",
                        className: 'dt-nowrap'
                    },
                    {
                        data: "transactionStatus",
                        title: "Status"
                    },
                    {
                        data: "purpose",
                        title: "Purpose"
                    },
                    {
                        data: "sendersAmount",
                        title: "Amount"
                    },
                    {
                        data: "fee",
                        title: "Fee"
                    },
                    {
                        data: "billCode",
                        title: "Bill Reference"
                    },

                    {
                        data: "bill_type",
                        title: "Bill Type"
                    },
                    {
                        data: "airtimeNumber",
                        title: "Airtime Number",
                        //className: "dt-nowrap"
                    },
                    {
                        data: "remitRecipientMomoName",
                        title: "MoMo Name",
                        //className: "dt-nowrap"
                    },

                    {
                        data: "remitRecipientMomoNumber",
                        title: "MoMo Number",
                        //className: "dt-nowrap"
                    },

                    {
                        data: "remitRecipientBankName",
                        title: "Bank Name"
                    },
                    {
                        data: "remitRecipientBankAccount",
                        title: "Bank Account #"
                    },
                    {
                        data: "remitRecipientBankAccountName",
                        title: "Bank Account Name",
                    },
                ],
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-info'
                    }
                ]

            });
            $.post("{{ route('api.customers.profile', ['profile' => Route::current()->parameter('profile')]) }}", {
                    _token: $('input[name="_token"]').val()
                })
                .done(function(data) {
                    $('#fullName2').val(data.data.profile.fullName)
                    $('#gender').val(data.data.profile.gender)
                    $('#email').val(data.data.profile.email)
                    $('#idType').val(data.data.profile.idType)
                    $('#idNumber').val(data.data.profile.idNumber)
                    $('#dob').val(data.data.profile.dob)
                    $('#address').val(data.data.profile.addressLine1)
                    $('#postCode').val(data.data.profile.postcode)
                    $('#accountType').val(data.data.profile.accountType)
                    $('#status').val(data.data.profile.status)

                    $('#fullName').text(data.data.profile.fullName)
                    $('#credit').text(data.data.profile.credit)
                    $('#debit').text(data.data.profile.debit)
                    $('#balance').text(data.data.profile.balance)
                    $('#phoneNum').text(data.data.profile.phoneNum)
                })
                .fail(function(xhr, status, error) {
                    $('.alert-dismissible').hide();
                    $('#alertWarning').html(xhr.responseText).show();
                });

            $('#frmCustomer').submit(function(evt) {
                    evt.preventDefault();

                    $.ajax({
                        url: "{{ route('api.customers.profile.update', ['profile' => Route::current()->parameter('profile')]) }}",
                        type: "PUT",
                        data: {
                            _token: $('input[name="_token"]').val(),
                            accountType: $('#accountType').val(),
                            status: $('#status').val()
                        },
                        success: function(data) {
                            $('.alert-dismissible').hide();
                            $('#alertSuccess').text(data.message).show();
                        },
                        error: function(xhr, status, error) {
                            $('.alert-dismissible').hide();
                            $('#alertWarning').html(xhr.responseText).show();
                        }
                    });
                });

        })
    </script>
@endsection
