@extends('layouts.app')
@section('title', 'Failed transactions')
@section('sub-title', 'Failed To Write Transactions and Manual Repair Requests')
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
            $('#failed-transactions').DataTable({
                "processing": true,
                "serverSide": true, // enables server-side processing
                "ajax": {
                    "url": "{{ route('api.transactions.failedToWrite') }}", // 🔥 your backend endpoint here
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
                    "searchPlaceholder": "Search transactions..."
                },
                responsive: true,
                 lengthMenu: [10, 100, 200,500,1000,2000],
                dom: 'Bfrltip',
                "columns": [
                    //{ data: "id", title: "ID" },
                    {
                        data: "created_at",
                        title: "Time"
                    },
                    {
                        data: "w_sender_name",
                        title: "Sender"
                    },
                    {
                        data: "foreignId",
                        title: "B-Bus ID",
                        className: 'dt-nowrap'
                    },
                    {
                        data: "transaction_uid",
                        title: "Transaction ID"
                    },
                    {
                        data: "transactionTypes",
                        title: "Trnx Type",
                         className: 'dt-nowrap'
                    },
                    {
                        data: "transactionStatus",
                        title: "Status"
                    },
                    {
                        data: "purpose",
                        title: "Purpose"
                    },
                    {
                        data: "sendersAmount",
                        title: "Amount"
                    },
                    {
                        data: "fee",
                        title: "Fee"
                    },
                    {
                        data: "billCode",
                        title: "Bill Reference"
                    },
                    {
                        data: "async_id",
                        title: "Async ID"
                    },
                    {
                        data: "bill_type",
                        title: "Bill Type"
                    },
                    {
                        data: "airtimeNumber",
                        title: "Airtime Number"
                    },
                    {
                        data: "remitRecipientMomoName",
                        title: "MoMo Name"
                    },
                    {
                        data: "remitRecipientBankAccount",
                        title: "Bank Account #"
                    },
                    {
                        data: "remitRecipientBankAccountName",
                        title: "Bank Account Name"
                    },
                    // {
                    //     data: "remitRecipientBankAccountName",
                    //     title: "Bank Account Name"
                    // },
                    // {
                    //     data: "remitRecipientBankAccountName",
                    //     title: "Bank Account Name"
                    // },

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

    <div class="row">
        <div class="col-md-12">
            <div class="card card-success card-outline shadow-sm">
                <!-- List of All Payout -->
                <div class="card-header" style="color:red">Failed To Wtite & Manual Repairs</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped display" id="failed-transactions">
                            <thead>
                                <tr>
                                    <th>Trnx Date</th>
                                    <th>Sender</th>
                                    <th>B-Bus ID</th>
                                    <th>Transaction ID</th>
                                    <th>Trnx Type</th>
                                    <th>Status</th>
                                    <th>Purpose</th>
                                    <th>Amount</th>
                                    <th>Fee</th>
                                    <th>Bill Reference</th>
                                    <th>Async ID</th>
                                    <th>Bill Type</th>
                                    <th>Airtime Number</th>
                                    <th>MoMo Name</th>
                                    <th>MoMo Number</th>
                                    <th>Bank Name</th>
                                    {{-- <th>Bank Account #</th>
                                    <th>Bank Account Name</th> --}}
                                    {{-- <th>View</th> --}}
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- /.content -->
@endsection
