@extends('layouts.app')
@section('title', 'Flagged Transactions')
@section('styles')
    <!-- DataTables CSS for Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
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
        $(document).ready(function() {
            $('#flagged-transactions').DataTable({
                "pageLength": 10, // show 10 rows per page
                "ordering": true, // enable column sorting
                "searching": true, // enable search box
                "processing": true,
                "serverSide": true, // enables server-side processing
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search transactions..."
                },
                "ajax": {
                    "url": "{{ route('api.transactions.flagged') }}",
                    "type": "GET",
                    "dataSrc": "data",
                    "data": function(d) {
                        d.trnx_Type = $("#trnx_Type").val();
                        d.d_from = $("#d_from").val();
                        d.d_to = $("#d_to").val();
                    }
                },
                responsive: true,
                lengthMenu: [10, 100, 200, 500, 1000, 2000],
                dom: 'Bfrltip',
                "columns": [{
                        data: "dateTime",
                        title: "Trnx Date"
                    },
                    {
                        data: "fullName",
                        title: "Sender"
                    },
                    {
                        data: "phoneNum",
                        title: "Phone Number"
                    },
                    {
                        data: "gender",
                        title: "Gender"
                    },
                    {
                        data: "dob",
                        title: "Date of Birth"
                    },
                    {
                        data: "nationality",
                        title: "Nationality"
                    },
                    {
                        data: "postcode",
                        title: "Postcode"
                    },
                    {
                        data: "addressLine1",
                        title: "Address"
                    },
                    {
                        data: "region",
                        title: "Region"
                    },
                    {
                        data: "idType",
                        title: "Id Type"
                    },
                    {
                        data: "idNumber",
                        title: "Id Number"
                    },
                    {
                        data: "foreignId",
                        title: "B-Bus ID"
                    },

                    {
                        data: "transaction_uid",
                        title: "Transaction ID"
                    },
                    {
                        data: "transactionTypes",
                        title: "Trnx Type"
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
                        title: "Airtime Number"
                    },
                    {
                        data: "remitRecipientMomoName",
                        title: "MoMo Name"
                    },
                    {
                        data: "remitRecipientMomoNumber",
                        title: "MoMo Number"
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
                        title: "Bank Account Name"
                    },
                    // {
                    //     data: "async_id",
                    //     title: "Async ID"
                    // },
                    // {
                    //     data: "app_version",
                    //     title: "App Version"
                    // },
                    //  {
                    //     data: null,
                    //     render: function(data, type, row) {
                    //         return '<button class="btn btn-sm btn-success view-btn">Details</button>';
                    //     },
                    //     orderable: false,
                    //     searchable: false
                    // }

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
        });
    </script>
@endsection
@section('content')
    <div class="card shadow-sm">
        <!-- Card Header -->
        <div class="card-header">
            <h5 class="mb-0">Transactions List</h5>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="flagged-transactions">
                    <thead class="bg-success text-white">
                        {{-- <tr>
                            <th>Trnx Date</th>
                            <th>Sender</th>
                            <th>B-Bus ID</th>
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
                            <th>View</th>
                        </tr> --}}
                    </thead>
                </table>
            </div>
        </div>
    @endsection
