@extends('layouts.app')
@section('title', 'Partially Onboarded')
@section('sub-title', 'Partially Onboarded Pay Customers List')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
        $('#customer-list').DataTable({
            "processing": true,
                "serverSide": true, // enables server-side processing
                "ajax": {
                    "url": "{{ route('api.customers.pay.partial_onboarding') }}", // 🔥 your backend endpoint here
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
                    "searchPlaceholder": "Search customers list..."
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
                        data: "phoneNum",
                        title: "Phone"
                    },
                    {
                        data: "fullName",
                        title: "Name"
                    },
                    // {
                    //     data: "has_password",
                    //     title: "Password Configured"
                    // }
                    {
                        data: 'has_password',
                        render: function (data, type, row) {
                        if (type === 'display') {
                            return data
                           ? '<i class="fa-solid fa-square-check" style="color:green; font-size:18px;"></i>'
        : '<i class="fa-regular fa-square" style="color:red; font-size:18px;"></i>';
                        }
                        return data; // for sort/filter
                        }
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
<div class="card shadow-sm">
    <!-- Card Header -->
    <div class="card-header">
        <h5 class="mb-0">This is a list of All Partially Onboarded Customers</h5>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="customer-list">
                <thead class="bg-success text-white">
                    <tr>
                                    <th>Date</th>
                                    <th>Phone</th>
                                    <th>Name</th>
                                    <th>Password Configured</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
