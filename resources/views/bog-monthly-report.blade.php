@extends('layouts.app')
@section('title', 'Investment Transactions')
@section('sub-title', 'All Investment Transactions')
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
            $('#all-transactions-bog').DataTable({
                "pageLength": 10, // show 10 rows per page
                "ordering": true, // enable column sorting
                "searching": true, // enable search box
                "order": [
                    [0, "desc"]
                ], // default sort by "Time" column
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search bog report..."
                },
                responsive: true,
                dom: 'Bfrtip', // B = buttons, f = filter, r = processing, t = table, i = info, p = pagination
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
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card card-success card-outline">
                <!--<div class="box-header with-border">Perform Transaction.</div>-->
                <div class="card-body">
                    <form role="form" method="post">
                        <div class="row">
                            <div class="col-md-3 mb-2 mb-md-0">
                                <div class="form-group">
                                    <label for="d_from">From</label>
                                <input type="date" name="d_from" required class="form-control" id="d_from" >
                                </div>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0">
                                <div class="form-group">
                                    <label for="d_to">To</label>
                                <input type="date" name="d_to" required class="form-control" id="d_to" >
                                </div>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0">
                                <div class="form-group">
                                    <label for="trnx_Type">Transaction Type</label>
                                <select class="form-control" required id="trnx_Type" name="trnx_Type" >
                                    <option value="MT-MOMO">MoMo Credit</option>
                                    <option value="MT-BANK">Bank Transfer</option>
                                    <option value="MT-BILL">Billers</option>
									<option value="MT-AIRTIME">Airtime</option>
									<option value="MT-PULL">MoMo Debit</option>
									<option value="COLLECTIONS">All Collections</option>
									<option value="FULFILMENTS">All Fulfilments</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0">
                                <div class="form-group">
                                    <label for="refund_btn">&nbsp;</label>
                                    <button type="submit" class="btn btn-success" style="width:100%" name="filtered_transactions">Generate Report</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card card-success card-outline">
                <div class="card-header">List of Filtered Transactions</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="all-transactions-bog">
                            <thead class="bg-success text-white">
                                <tr>
                                    th>Trnx Date</th>
<th>Sender</th>
<th>Phone Number</th>
<th>Gender</th>
<th>Date of Birth</th>
<th>nationality</th>
<th>postcode</th>
<th>addressLine1</th>
<th>region</th>
<th>idType</th>
<th>idNumber</th>
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
<th>Async ID</th>
<th>APP VERSION</th>
<th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- /.content -->
@endsection
