@extends('layouts.app')
@section('title', 'Reset Meter Profile')
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
            $('#all-meters').DataTable({
                "pageLength": 10, // show 10 rows per page
                "ordering": true, // enable column sorting
                "searching": true, // enable search box
                "order": [
                    [0, "desc"]
                ], // default sort by "Time" column
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search meters..."
                },
                "ajax": {
                    "url": "{{ route('api.meters.index') }}", // 🔥 your backend endpoint here
                    "type": "GET", // or POST if your API expects it
                    "dataSrc": "data" // adjust based on your API JSON structure
                },
                responsive: true,
                lengthMenu: [10, 100, 200, 500, 1000, 2000],
                dom: 'Bfrltip',
                "columns": [{
                        data: "created_at",
                        title: "Date Enrolled"
                    },
                    {
                        data: "meter_no",
                        title: "Meter #"
                    },
                    {
                        data: "meter_info",
                        title: "Meter Details",
                        className: 'dt-nowrap'
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
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card card-success card-outline shadow-sm">
                <!--<div class="box-header with-border">Perform Transaction.</div>-->
                <div class="card-body">
                    <form method="post" role="form"
                        onsubmit="return confirm('Are you sure you want to perform this transaction');">
                        @csrf
                        <label for="transaction_id">Enter Meter Number</label>
                        <div class="row">
                            <div class="col-md-10 mb-2 mb-md-0">
                                <div class="form-group">
                                    <input type="text" style="width:100%" name="transaction_id" id="transaction_id"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2 mb-2 mb-md-0">
                                <div class="form-group">
                                    <input type="submit" style="width:100%" class="btn btn-success" name="remove_meter"
                                        value="Reset">
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @if (isset($request) && $request->get('transaction_id')) --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success card-outline shadow-sm">
                <!-- Card Header -->
                <div class="card-header">
                    <h5 class="mb-0">This is a list of Meters</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="all-meters">
                            <thead class="bg-success text-white">
                                <tr>
                                    <th>Date Enrolled</th>
                                    <th>Meter #</th>
                                    <th>Meter Details</th>
                                    {{-- <th>View Status</th>
                     						<th>View Account</th> --}}
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}
    </section>
    <!-- /.content -->
@endsection
