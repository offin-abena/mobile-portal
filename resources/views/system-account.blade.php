@extends('layouts.app')
@section('title', 'System Accounts Setup')
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
            const table = $('#user-list').DataTable({
                "pageLength": 10, // show 10 rows per page
                "ordering": true, // enable column sorting
                "searching": true, // enable search box
                "processing": true,
                "serverSide": true,
                "order": [
                    [0, "desc"]
                ], // default sort by "Time" column
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search accounts..."
                },
                lengthMenu: [10, 100, 200, 500, 1000, 2000],
                dom: 'Bfrltip',
                "ajax": {
                    "url": "{{ route('api.system.accounts') }}", // 🔥 your backend endpoint here
                    "type": "GET", // or POST if your API expects it
                    "dataSrc": "data" // adjust based on your API JSON structure
                },
                "columns": [{
                        data: "countryResidence",
                        title: "Country"
                    },
                    {
                        data: "phoneNum",
                        title: "Phone"
                    },
                    {
                        data: "fullName",
                        title: "Full Name"
                    },
                    {
                        data: "groupName",
                        title: "Group"
                    },
                    {
                        data: "created_at",
                        title: "Date"
                    },
                    {
                        data: "status",
                        title: "Status"
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-sm btn-success edit-btn">Edit</button>';
                        },
                        orderable: false,
                        searchable: false
                    }

                ],
                responsive: true,
                lengthMenu: [10, 100, 200, 500, 1000, 2000],
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

            $('#user-list').on('click', '.edit-btn', function() {
                let rowData = table.row($(this).parents('tr')).data();
                //console.log('Row data',rowData)
                $('#phoneNum').val(rowData.phoneNum);
                $('#password').val(rowData.password);
                $('#fullName').val(rowData.fullName);
                $('#accountType').val(rowData.uGroup);
                $('#country').val(rowData.countryResidence);
            });

            $('#frm_admin_user').submit(function(evt) {
                evt.preventDefault();

                const formData = {
                    phoneNum: $('#phoneNum').val(),
                    password: $('#password').val(),
                    fullName: $('#fullName').val(),
                    accountType: $('#accountType').val(),
                    country: $('#country').val(),
                    _token: $('input[name="_token"]').val() // CSRF token
                }

                $.ajax({
                    url: "{{ route('api.system.account.create') }}", // Laravel route
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $('.alert-dismissible').hide();
                        $('#alertSuccess').text(response.message);
                        $('#alertSuccess').show();
                        table.ajax.reload(null, false); // false = keep current pagination
                    },
                    error: function(xhr) {
                        $('.alert-dismissible').hide();

                        let errorHtml = '<div class="alert alert-danger"><ul>';

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            // Laravel validation error
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorHtml += '<li>' + value[0] + '</li>';
                            });
                        } else if (xhr.status === 400) {
                            // Bad request
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorHtml += '<li>' + xhr.responseJSON.message + '</li>';
                            } else {
                                errorHtml += '<li>Bad request. Please check your input.</li>';
                            }
                        } else {
                            // General / server error
                            errorHtml +=
                                '<li>An unexpected error occurred. Please try again later.</li>';
                        }

                        errorHtml += '</ul></div>';
                        $('#alertWarning').html(errorHtml).show();
                    }
                });
            })

        });
    </script>
@endsection
@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    @include('components.system-account-form')
                </div>

                <div class="col-md-8">
                    @include('components.system-account-list')
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
