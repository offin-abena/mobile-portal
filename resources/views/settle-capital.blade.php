@extends('layouts.app')
@section('title', 'Settle Capital')
@section('sub-title', 'Settle Capital Collection Into Custodian Account')
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
        $('#settle-capital-list').DataTable({
          "processing": true,
                "serverSide": true, // enables server-side processing
                "ajax": {
                    "url": "{{ route('api.settlements.capital') }}", // 🔥 your backend endpoint here
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
                    "searchPlaceholder": "Search settlements list..."
                },
                responsive: true,
                lengthMenu: [10, 100, 200,500,1000,2000],
                dom: 'Bfrltip',
                "columns": [
                    {
                        data: "bank_name",
                        title: "Name of Bank / Account Name"
                    },
                    {
                        data: "account_number",
                        title: "Account Number"
                    },
                    {
                        data: "amount",
                        title: "Amount"
                    },
                    {
                        data: "authorization_code",
                        title: "Authorization Code"
                    },
                    {
                        data: "user",
                        title: "User"
                    }

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
        <div class="card card-success card-outline">
            <!--<div class="box-header with-border">Perform Transaction.</div>-->
            <div class="card-body">
                <form method="post" role="form"
                    onsubmit="return confirm('Are you sure you want to perform this transaction');">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 mb-2 mb-md-0">
								<label for="transaction_id">Name of Bank / Account Name</label>
                                <input type="text" style="width:100%" name="bank" value="Republic Bank / RBGN/Brassica Alpha Fund PLC" id=""  class="form-control" required readonly>
						</div>
                        <div class="col-md-2 mb-2 mb-md-0">
								<label for="transaction_id">Account Number</label>
                                <input type="text" style="width:100%" name="account_no" value="0021011343801" placeholder=""   class="form-control" required readonly>
						</div>
                        <div class="col-md-3 mb-2 mb-md-0">
								<label for="transaction_id">Enter Amount</label>
                                <input type="text" style="width:100%" name="amount" value="0.00" id=""  class="form-control" required >
						</div>
                        <div class="col-md-2 mb-2 mb-md-0">
								<label for="transaction_id">Authorization Code</label>
                                <input type="password" style="width:100%" name="code"  class="form-control" required >
						</div>
                        <div class="col-md-2 mb-2 mb-md-0">
                            <div class="form-group">
                                <label for="transaction_id"> &nbsp;</label>
                                <input type="submit" style="width:100%" class="btn btn-success" name="credit_merchant" value="Process Transfer">
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
            <div class="card-header">Capital Settlement History</div>
            <div class="card-body">
                <div class="table-responsive">
            <table class="table table-striped table-bordered" id="settle-capital-list">
                <thead class="bg-success text-white">
                    <tr>
                                                <th>Name of Bank / Account Name</th>
                                                <th>Account Number</th>
                                                <th>Amount</th>
                                                <th>Authorization Code</th>
                                                <th>User</th>
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
