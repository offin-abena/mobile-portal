@extends('layouts.app')
@section('title', 'Prepaid Transactions')
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
            $('#prepaid-transactions-list').DataTable({
                processing: true,
                serverSide: false, // 👈 client-side pagination
                order: [0, 'desc'],
                lengthMenu: [100, 500, 1000, 2000, 5000, 10000], // 👈 options in dropdown
                pageLength: 100,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'copy',  className: 'btn btn-secondary' },
                    { extend: 'csv',   className: 'btn btn-success' },
                    { extend: 'excel', className: 'btn btn-success' },
                    { extend: 'pdf',   className: 'btn btn-danger' },
                    { extend: 'print', className: 'btn btn-info' }
                ],
                language: {
                    zeroRecords: "No payments found"
                },
                columns: [
                    { data: "paymentDate",        name: "paymentDate" },
                    { data: "accountNumber",      name: "accountNumber" },
                    { data: "servicePointNumber", name: "servicePointNumber" },
                    { data: "paymentAmount",      name: "paymentAmount" },
                    { data: "paymentType",        name: "paymentType" },
                    { data: "transactionId",      name: "transactionId", className: 'no-sort' },
                    { data: "meterNumber",        name: "meterNumber", className: 'no-sort' }
                ],
                columnDefs: [
                    { targets: 'no-sort', orderable: false }
                ],
                ajax: {
                    url: "{{ route('api.meters.transactions') }}",
                    type: "GET",
                    dataSrc: "data" ,
                    data: function (d) {
                        d.meterNumber = "{{ old('meterNumber') }}";
                    }
                }
            })
        });
    </script>
@endsection
@section('content')
    @include('components.green-bordered-inputs')

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card card-success card-outline shadow-sm">
                <div class="card-body">
                    <form method="post" role="form" action="{{ route('transactions.postpaid') }}"
                        onsubmit="return confirm('Are you sure you want to perform this transaction');">
                         @csrf
                        <div class="form-group">
                            <label for="transaction_id">Enter Meter Number</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input class="styled-element" type="text" style="width:100%" name="meterNumber"
                                        id="transaction_id" class="form-control" value="{{old('meterNumber')}}">
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" class="styled-element styled-button" style="width:100%"
                                        class="btn btn-success" name="polymorph_meter_transactions"
                                        value="Get Meter Transactions">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success card-outline shadow-sm">
                <!-- List of All Payout -->
                <div class="card-header" style="color:red">List of All Postpaid Transactions</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="prepaid-transactions-list">

                            <thead>
                                <tr>
                                    <th>Trnx Date</th>
                                    <th>Account Number</th>
                                    <th>Service Point Number</th>
                                    <th>Payment Amount</th>
                                    <th>Payment Type</th>
                                    <th>Transaction ID</th>
                                    <th>Meter ID</th>
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
