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
            $('#all-transactions-filter').DataTable({
                "pageLength": 10, // show 10 rows per page
                "ordering": true, // enable column sorting
                "searching": true, // enable search box
                "order": [
                    [0, "desc"]
                ], // default sort by "Time" column
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search transaction..."
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
                                    <select class="form-control" required id="trnx_Type" name="trnx_Type" required>
                                        <option value="">===Select an Option===</option>
                                        <option value="DIRECT">Direct Top Ups</option>
                                        <option value="ROUNDUP">Round Ups</option>
                                        <option value="REDEMPTION">Redemptions</option>
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
            <div class="card card-primary card-outline">
                <div class="card-header">List of Cash Transactions From 2025-09-01 To 2025-09-10</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="all-transactions-filter">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>Date</th>
                                    <th>Investor's Name</th>
                                    <th>Investor's Contact</th>
                                    <th>Amount Invested</th>
                                    <th>Transaction ID</th>
                                    <th>Trnx Type</th>
                                    <th>Collection Status</th>
                                    <th>Collection Reference</th>
                                    <th>Investment Status</th>
                                    <th>Fund Code</th>
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
