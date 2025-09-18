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
            "order": [[0, "desc"]], // default sort by "Time" column
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search transactions..."
            },
            responsive: true,
            dom: 'Bfrtip', // B = buttons, f = filter, r = processing, t = table, i = info, p = pagination
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
