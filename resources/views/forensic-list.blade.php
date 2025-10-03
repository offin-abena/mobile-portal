@extends('layouts.app')
@section('title', 'Forensic List')
@section('sub-title', 'Forensic Investigations List')
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
            $('#forensic-list').DataTable({
                "processing": true,
                "serverSide": true, // enables server-side processing
                "ajax": {
                    "url": "{{ route('api.forensics.index') }}", // 🔥 your backend endpoint here
                    "type": "GET", // or POST if your API expects it
                    "dataSrc": "data" // adjust based on your API JSON structure
                },
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search transactions list..."
                },
                responsive: true,
                lengthMenu: [10, 100, 200,500,1000,2000],
                dom: 'Bfrltip',
                "columns": [
                    {
                        data: "Date",
                        title: "Date"
                    },
                    {
                        data: "Account",
                        title: "Account"
                    },
                    {
                        data: "Full Name",
                        title: "Phone"
                    },
                    {
                        data: "Fund Source Provider",
                        title: "Fund Source Provider"
                    },
                    {
                        data: "Fund Source Number",
                        title: "Fund Source Number"
                    },
                    {
                        data: "Fund Source Name",
                        title: "Fund Source Name"
                    },
                    {
                        data: "Amount",
                        title: "Amount"
                    },
                    {
                        data: "T-Type",
                        title: "T-Type"
                    },
                    {
                        data: "Trnx ID",
                        title: "Trnx ID"
                    },
                    {
                        data: "T-Status",
                        title: "T-Status"
                    },
                    {
                        data: "Momo Recipient Name",
                        title: "Momo Recipient Name"
                    },
                    {
                        data: "Momo Recipient Number",
                        title: "Momo Recipient Number"
                    },
                    {
                        data: "Bank Recipient Name",
                        title: "Bank Recipient Name"
                    },
                    {
                        data: "Bank Name",
                        title: "Bank Name"
                    },
                    {
                        data: "Bank Account Number",
                        title: "Bank Account Number"
                    },
                    {
                        data: "B_BUS_ID",
                        title: "B_BUS_ID"
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
        });
    </script>
@endsection
@section('content')
    <div class="card shadow-sm">
        <!-- Card Header -->
        <div class="card-header">
            <h5 class="mb-0">Forensic Investigations List</h5>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="forensic-list">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>Date</th>
                            <th>Account</th>
                            <th>Full Name</th>
                            <th>Fund Source Provider</th>
                            <th>Fund Source Number</th>
                            <th>Fund Source Name</th>
                            <th>Amount</th>
                            <th>T-Type</th>
                            <th>Trnx ID</th>
                            <th>T-Status</th>
                            <th>Momo Recipient Name</th>
                            <th>Momo Recipient Number</th>
                            <th>Bank Recipient Name</th>
                            <th>Bank Name</th>
                            <th>Bank Account Number</th>
                            <th>B_BUS_ID</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    @endsection
