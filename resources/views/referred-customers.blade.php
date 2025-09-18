@extends('layouts.app')
@section('title', 'Referred Customers')
@section('sub-title', 'Referred Customers List ')
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
            $('#customer-list-referred').DataTable({
                "processing": true,
                "serverSide": true,        // enables server-side processing
                "ajax": {
                    "url": "{{ route('api.customers.referred') }}",   // 🔥 your backend endpoint here
                    "type": "GET",              // or POST if your API expects it
                    "dataSrc": "data"               // adjust based on your API JSON structure
                },
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "order": [[0, "desc"]],
                "lengthMenu": [10, 25, 100, 100000],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search managers..."
                },
                responsive: true,
                dom: 'Bfrtip',
                "columns": [
                        { data: "created_at", title: "Date" },
                        { data: "full_name", title: "Full Name" },
                        { data: "phone_num", title: "Contact/ID" },
                        { data: "district", title: "District" },
                        { data: "region", title: "Region" },
                        { data: "region", title: "Referred By" },
                        { data: "status", title: "Status" }

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
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!-- Main content -->
            <section class="content">
                <div class="row mb-4">
                    <div class="col-md-12">
                        @include('components.referred-customer-form')
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @include('components.referred-customer-list')
                    </div>
                </div>
            </section>
            <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
