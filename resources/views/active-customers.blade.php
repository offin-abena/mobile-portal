@extends('layouts.app')
@section('title', 'Active Customers')
@section('sub-title', 'Active Customers Profiling')
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
        $('#customer-report').DataTable({
            "pageLength": 10,      // show 10 rows per page
            "ordering": true,      // enable column sorting
            "searching": true,     // enable search box
            "order": [[0, "desc"]], // default sort by "Time" column
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search customers..."
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
<div class="card mb-3">
  <div class="card-header">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
      <h4 class="mb-2 mb-md-0"><strong>This is a list of All Active Customers</strong></h4>

      <form class="row gy-2 gx-3 align-items-center" method="post">
        <div class="col-12 col-md-auto">
            <label class="form-label fw-bold mb-0">Filter:</label>
        </div>

        <div class="col-6 col-md-auto">
            <div class="form-check">
            <input class="form-check-input" type="radio" id="filter1M" name="ref" value="1M">
            <label class="form-check-label" for="filter1M">1 Month</label>
            </div>
        </div>

        <div class="col-6 col-md-auto">
            <div class="form-check">
            <input class="form-check-input" type="radio" id="filter2M" name="ref" value="2M">
            <label class="form-check-label" for="filter2M">2 Months</label>
            </div>
        </div>

        <div class="col-6 col-md-auto">
            <div class="form-check">
            <input class="form-check-input" type="radio" id="filter3M" name="ref" value="3M">
            <label class="form-check-label" for="filter3M">3 Months</label>
            </div>
        </div>

        <div class="col-6 col-md-auto">
            <div class="form-check">
            <input class="form-check-input" type="radio" id="filter6M" name="ref" value="6M">
            <label class="form-check-label" for="filter6M">6 Months</label>
            </div>
        </div>

        <div class="col-12 col-md-auto">
            <button name="post_ref" type="submit" class="btn btn-primary btn-sm">
            Apply Filter
            </button>
        </div>
        </form>

    </div>
  </div>
</div>


@include('components.active-profile-transactions-table')
@endsection
