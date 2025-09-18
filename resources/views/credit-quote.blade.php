@extends('layouts.app')
@section('title', 'Credit Quota')
@section('sub-title', 'Merchant Account Credit Management')
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
{{-- <script>
 $(document).ready(function () {
        $('#quote-list').DataTable({
            "pageLength": 10,      // show 10 rows per page
            "ordering": true,      // enable column sorting
            "searching": true,     // enable search box
            "order": [[0, "desc"]], // default sort by "Time" column
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search quota..."
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
</script> --}}
@endsection
@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <!--<div class="box-header with-border">Perform Transaction.</div>-->
            <div class="card-body">
                <form method="post" role="form"
                    onsubmit="return confirm('Are you sure you want to perform this transaction');">
                     @csrf
                    <div class="row">
                        <div class="col-md-3 mb-2 mb-md-0">
								<label for="transaction_id">Enter Merchant Phone Number</label>
                                <input type="text" style="width:100%" name="mobile_no" id="mobile_no" placeholder="233243056828"   class="form-control" required>
						</div>
                        <div class="col-md-2 mb-2 mb-md-0">
								<label for="transaction_id">Enter Amount</label>
                                <input type="text" style="width:100%" name="amount" value="1.00" id=""  class="form-control" >
						</div>
                        <div class="col-md-3 mb-2 mb-md-0">
								<label for="transaction_id">Enter Company Code</label>
                                <input type="text" style="width:100%" name="company_code" value="" id=""  class="form-control" >
						</div>
                        <div class="col-md-2 mb-2 mb-md-0">
								<label for="transaction_id">Select Action Type</label>
								<select class="form-control" name="type" required id="status">
                                    <option value="INFO">Info</option>
                                    <option value="ACTIVATE">Activate</option>
                                    <option value="CREDIT">General Credit</option>
									<option value="BONDED-CREDIT">Bonded Credit</option>
                                </select>
						</div>
                        <div class="col-md-2 mb-2 mb-md-0">
                            <div class="form-group">
                                <label for="transaction_id"> &nbsp;</label>
                                <input type="submit" style="width:100%" class="btn btn-success" name="credit_merchant" value="Process">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- <div class="row mb-3">
    <div class="col-md-12">
        <div class="card card-success card-outline">
            <div class="card-header">Quota History</div>
            <div class="card-body">
                <div class="table-responsive">
            <table class="table table-striped table-bordered" id="quote-list">
                <thead class="bg-success text-white">
                    <tr>
                                                <th>Merchant Phone</th>
                                                <th>Amount</th>
                                                <th>Company Code</th>
                                                <th>Action Type</th>
                                                <th>User</th>
                    </tr>
                </thead>
            </table>
        </div>
            </div>
        </div>
    </div>
</div> --}}
</section>
<!-- /.content -->
@endsection
