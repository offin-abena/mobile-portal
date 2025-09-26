@extends('layouts.app')
@section('title', 'Top Selling Customers')
@section('sub-title', 'Top Selling Customers List')
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
           const table=$('#customer-list').DataTable({
                "pageLength": 10, // show 10 rows per page
                "ordering": true,      // enable column sorting
            "searching": true, // enable search box
            "processing": true,
            "serverSide": true,
                "order": [
                    [0, "desc"]
                ], // default sort by "Time" column
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search customers..."
                },
                "ordering": true, // enable column sorting
                "searching": true, // enable search box
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('api.customers.top-selling') }}",
                    "type": "GET",
                    "dataSrc": "data"
                },
                responsive: true,
                lengthMenu: [10, 100, 200, 500, 1000, 2000],
                "columns": [{
                        data: "created_at",
                        title: "Time"
                    },
                    {
                        data: "country",
                        title: "Country"
                    },
                    {
                        data: "phoneNum",
                        title: "Phone"
                    },
                    {
                        data: "fullName",
                        title: "Name"
                    },
                    {
                        data: "gender",
                        title: "Gender"
                    },
                    {
                        data: "postcode",
                        title: "GP-GPS Code"
                    },
                    {
                        data: "addressline1",
                        title: "Address"
                    },
                    {
                        data: "totalAmount",
                        title: "Total Purchase"
                    },
                    {
                        data: "numTransactions",
                        title: "Transaction #"
                    },
                     {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-sm btn-success view-btn">View Details</button>';
                        },
                        orderable: false,
                        searchable: false
                    }

                ],
                dom: 'Bfrltip',
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

            $('#customer-list').on('click', '.view-btn', function() {
                let rowData = table.row($(this).parents('tr')).data();

                console.log('Customer data',rowData)

                setTimeout(() => {
                    location.href = `/customers/${rowData.senderID}/transactions`;
                }, 300);
            });
        });
    </script>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-success card-outline shadow-sm">
                <!-- List of All Payout -->
                <div class="card-header" style="color:red">This is a list of All Top Selling Customers</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="customer-list">

                            <thead>
                                <tr>
                                    {{-- <th>Time</th>
                                    <th>Country</th>
                                    <th>Phone</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>GP-GPS Code</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Total Purchases</th> --}}
                                    {{-- <th>Transactions #</th> --}}
                                    {{-- <th>Customer Details</th> --}}
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
