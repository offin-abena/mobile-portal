@extends('layouts.app')
@section('title', 'User List')
@section('styles')
<!-- DataTables CSS for Bootstrap 5 -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }
    .switch input { display: none; }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #ccc;
        border-radius: 24px;
        transition: .4s;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        border-radius: 50%;
        transition: .4s;
    }
    input:checked + .slider {
        background-color: #4CAF50;
    }
    input:checked + .slider:before {
        transform: translateX(26px);
    }
</style>
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
      const table=$('#user-list').DataTable({
            "processing": true,
            "serverSide": true,        // enables server-side processing
            "ajax": {
                "url": "{{ route('api.users.admins') }}",   // 🔥 your backend endpoint here
                "type": "GET",              // or POST if your API expects it
                "dataSrc": "data"               // adjust based on your API JSON structure
            },
            "pageLength": 10,
            "ordering": true,
            "searching": true,
            "order": [[0, "desc"]],

            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search admins list..."
            },
            responsive: true,
            lengthMenu: [10, 100, 200, 500, 1000, 2000],
            dom: 'Bfrltip',

            "columns": [
                    { data: "fullName", title: "Full Name" },
                    { data: "username", title: "User Name" },
                    { data: "userType", title: "User Type" },
                    { data: "AdminName", title: "Added By" },
                    { data: "status", title: "Status" },
                    {
                        data: "status",
                       render: function (data, type, row) {
                        let checked = data === 'ACTIVE' ? 'checked' : '';
                        return `
                            <label class="switch">
                            <input type="checkbox" class="toggle-status" ${checked}>
                            <span class="slider"></span>
                            </label>
                        `
                        },
                        orderable: false,
                        searchable: false
                    }

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
            ],


        });

        $('#user-list').on('change', '.toggle-status', function() {
            let row = table.row($(this).parents('tr'));
            let data = row.data();

            let newStatus = this.checked ? 'ACTIVE' : 'INACTIVE';

            data['status']=newStatus;

            row.data(data).draw(false);

            $.post("{{ route('api.users.admins.status.change') }}",{status:newStatus,id:data['id'],_token:$('input[name="_token"]').val()},function(res){
                  console.log("Server updated:", res);
            })
        });
    });
</script>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	<?php
    // echo "{$cus['phoneNum']} {$cus['emailadd']}";
    //var_dump($resp);
    ?>
        <h1>
            Back Office User Management

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                @include('components.user-form')
            </div>

            <div class="col-md-8">
                @include('components.user-list')
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
