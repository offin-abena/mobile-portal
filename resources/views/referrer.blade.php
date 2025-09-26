@extends('layouts.app')
@section('title', 'Referrer List')
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
      const table=$('#referrers-list').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('api.referrers.index') }}",
                "type": "GET",
                "dataSrc": "data",
                "error": function(xhr, error, thrown) {
                    console.error('DataTable AJAX error:', error);
                    console.error('Response:', xhr.responseText);
                }
            },
            "pageLength": 10,
            "ordering": true,
            "searching": true,
            "order": [[0, "desc"]],
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search referrer list..."
            },
            "responsive": true,
            "lengthMenu": [10, 100, 200, 500, 1000, 2000],
            "dom": 'Bfrtlip',
            "autoWidth": false,
            "columns": [
                { 
                    "data": "code", 
                    "title": "Code",
                    "width": "10%"
                },
                { 
                    "data": "fullName", 
                    "title": "Name",
                    "width": "20%"
                },
                { 
                    "data": "phone", 
                    "title": "Phone",
                    "width": "15%"
                },
                { 
                    "data": "email", 
                    "title": "Email",
                    "width": "20%"
                },
                { 
                    "data": "gender", 
                    "title": "Gender",
                     "render": function(data, type, row) {
                        return data ? data.charAt(0).toUpperCase() + data.slice(1) : '';
                    }
                },
                { 
                    "data": "region", 
                    "title": "Region",
                    "width": "15%",
                     "render": function(data, type, row) {
                        return data ? data.charAt(0).toUpperCase() + data.slice(1) : '';
                    }
                },
                { 
                    "data": "referrer_type", 
                    "title": "Type",
                     "render": function(data, type, row) {
                        return data ? data.charAt(0).toUpperCase() + data.slice(1) : '';
                    }
                    
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

        $('#referrers-list').on('click', '.edit-btn', function() {
            let row = table.row($(this).parents('tr'));
            let data = row.data();

            //console.log('Data',data)

            $('#id').val(data.id)
            $('#code').val(data.code)
            $('#fullName').val(data.fullName)
            $('#phone').val(data.phone)
            $('#email').val(data.email)
            $('#gender').val(data.gender)
            $('#region').val(data.region)
            $('#referrer_type').val(data.referrer_type)
        });

        $('#frmReferrer').submit(function(evt){
            evt.preventDefault();
            
            const url=`/api/referrers/save/${$('#id').val()}`

            $.post(url,{
                _token:$('input[name="_token"]').val(),
                code:$('#code').val(),
                fullName:$('#fullName').val(),
                phone:$('#phone').val(),
                email:$('#email').val(),
                gender:$('#gender').val(),
                region:$('#region').val(),
                referrer_type:$('#referrer_type').val(),
            })
            .done(function(res){
                 $('.alert-dismissible').hide();
                 $('#alertSuccess').text(res.message);
                 $('#alertSuccess').show();
            })
            .fail(function(xhr, status, error) {
                $('.alert-dismissible').hide();
                $('#alertWarning').text(xhr.responseText);
                $('#alertWarning').show();
            });
        })
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
            Referrers Management

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                @include('components.referrer-form')
            </div>

            <div class="col-md-8">
                @include('components.referrer-list')
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
