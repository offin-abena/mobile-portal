@extends('layouts.app')
@section('title', 'TSA TM Database')
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
            $('#tsa-list').DataTable({
                "processing": true,
                "serverSide": true,        // enables server-side processing
                "ajax": {
                    "url": "{{ route('api.tsa.index') }}",   // 🔥 your backend endpoint here
                    "type": "GET",              // or POST if your API expects it
                    "dataSrc": "data"               // adjust based on your API JSON structure
                },
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "order": [[0, "desc"]],
                lengthMenu: [10, 100, 200,500,1000,2000],
                lengthChange: true,
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search managers..."
                },
                responsive: true,
                dom: 'Bfrltip',
                "columns": [
                        { data: "created_at", title: "Registration Date" },
                        { data: "full_name", title: "Full Name" },
                        { data: "phone_num", title: "Phone Number" },
                        { data: "reference_code", title: "Reference Code" },
                        { data: "amount_limit", title: "Transaction Limit" },
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
@include('components.green-bordered-inputs')

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card card-success card-outline shadow-sm">
                <div class="card-body">
                    <form method="post" role="form"
                        onsubmit="return confirm('Are you sure you want to perform this transaction');">
                        @csrf
                         <div class="form-group">

								<div class="row">
            					<div class="col-md-2">
								<label for="fullName">&nbsp;&nbsp;Reference Code</label>
                                <input class="styled-element"  type="text" style="width:100%" name="referenceCode"   class="form-control" required>
								</div>
								<div class="col-md-3">
								<label for="fullName">&nbsp;&nbsp;TM's Full Name</label>
                                <input class="styled-element"  type="text" style="width:100%" name="fullName"   class="form-control" required>
								</div>

								<div class="col-md-2">
								<label for="phoneNum">&nbsp;&nbsp;TM's Phone Number</label>
                                <input class="styled-element"  type="text" style="width:100%" name="phoneNum"  class="form-control" required>
								</div>

								<div class="col-md-3">
								<label for="amount">&nbsp;&nbsp;TM's Transaction Limit</label>
                                <input class="styled-element"  type="text" style="width:100%" name="amount"  class="form-control" required>
								</div>

								<div class="col-md-2">
								<label for="">&nbsp;</label>
								<input type="submit" class="styled-element styled-button" style="width:100%" class="btn btn-success" name="register_tsa_tms" value="Add TSA TM">
								</div>
								</div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (isset($payload))
     <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline shadow-sm">
                <!-- List of All Payout -->
                <div class="card-header" style="color:red">List of TSA Territory Managers</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tsa-list">
                            <thead>
                                <tr>
                                    <th>Registration Date</th>
                                    <th>Full Name</th>
                                    <th>Phone Number</th>
                                    <th>Reference Code</th>
                                    <th>Transaction Limit</th>
									 <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    @endif

    </section>
    <!-- /.content -->
@endsection
