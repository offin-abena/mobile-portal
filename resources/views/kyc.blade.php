@extends('layouts.app')
@section('title', 'Kyc Limits')
@section('sub-title', 'List of Configured KYC Limits')
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
        $('#kyc-limits').DataTable({
            "pageLength": 10,      // show 10 rows per page
            "ordering": true,      // enable column sorting
            "searching": true, // enable search box
            "processing": true,
            "serverSide": true,// enable search box
            "order": [[0, "desc"]], // default sort by "Time" column
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search kyc details..."
            },
           "ajax": {
                    "url": "{{ route('api.kycs.index') }}", // 🔥 your backend endpoint here
                    "type": "GET", // or POST if your API expects it
                    "dataSrc": "data" // adjust based on your API JSON structure
                },
             responsive: true,
                lengthMenu: [10, 100, 200, 500, 1000, 2000],
                dom: 'Bfrltip',
            "columns": [
                    {
                        data: "id",
                        title: "ID"
                    },
                    {
                        data: "name",
                        title: "KYC Type"
                    },
                    {
                        data: "transaction_limit",
                        title: "Transaction Limit",
                        //className: 'dt-nowrap'
                    },
                    {
                        data: "dailyAmount",
                        title: "Daily Limit",
                        //className: 'dt-nowrap'
                    },
                    {
                        data: "monthlyAmount",
                        title: "Monthly Limit",
                        //className: 'dt-nowrap'
                    }


                ],
            responsive: true,
            lengthMenu: [10, 100, 200, 500, 1000, 2000],
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
<div class="card shadow-sm">
    <!-- Card Header -->
    <div class="card-header">
        <h5 class="mb-0">KYC Limits</h5>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="kyc-limits">
                <thead class="bg-success text-white">
                    <tr>
                                                <th>#</th>
                                                <th>KYC Type</th>
                                                <th>Transaction Limit</th>
                                                <th>Daily Limit</th>
                                                <th>Monthly Limit</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
