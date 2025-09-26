@extends('layouts.app')
@section('sub-title', 'All Customer Refund Transactions Candidates')
@section('title', 'Refund Candidates')
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
 $(document).ready(function () {
        $('#refund-candidate-list').DataTable({
            "pageLength": 10,      // show 10 rows per page
            "ordering": true,      // enable column sorting
            "searching": true,     // enable search box
            "serverSide": true,
            "order": [[0, "desc"]], // default sort by "Time" column
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search transactions..."
            },
           "ajax": {
                "url": "{{ route('api.transactions.refundCandidates') }}", // 🔥 your backend endpoint here
                "type": "GET", // or POST if your API expects it
                "dataSrc": "data" // adjust based on your API JSON structure
            },
            responsive: true,
           lengthMenu: [10, 100, 200, 500, 1000, 2000],
                dom: 'Bfrltip',
            "columns": [
                    //{ data: "id", title: "ID" },
                    {
                        data: "created_at",
                        title: "Trnx Date"
                    },
                    {
                        data: "customer",
                        title: "Sender"
                    },
                    {
                        data: "b_bus_id",
                        title: "B-Bus Fulfiment ID",
                        className: 'dt-nowrap'
                    },
                    {
                        data: "transaction_uid",
                        title: "Transaction ID"
                    },
                    {
                        data: "transaction_type",
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
                        data: "remitRecipientMomoName",
                        title: "MoMo Name",
                        className: "dt-nowrap"
                    },
                    {
                        data: "airtimeNumber",
                        title: "Airtime Number",
                         className: "dt-nowrap"
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
                         className: "dt-nowrap"
                    },
                    {
                        data: "b_bus_collection_id",
                        title: "B-Bu Collection ID"
                    },
                    {
                        data: "async_id",
                        title: "Async ID"
                    },
                    {
                        data: "app_version",
                        title: "App Version"
                    }
                    // {
                    //     data: "remitRecipientBankAccountName",
                    //     title: "Bank Account Name"
                    // },
                    // {
                    //     data: "remitRecipientBankAccountName",
                    //     title: "Bank Account Name"
                    // },

                ],
            buttons: [
            {
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
@include('components.refund-candidate-list')
@endsection
