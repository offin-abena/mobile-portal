@extends('layouts.app')
@section('title', 'Add Translation')
@section('sub-title', 'Translations - Manual Setup')
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
      const table=$('#translations').DataTable({
            "processing": true,
                "serverSide": true, // enables server-side processing
                "ajax": {
                    "url": "{{ route('api.translations.index') }}", // 🔥 your backend endpoint here
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
                    "searchPlaceholder": "Search translations list..."
                },
                responsive: true,
                lengthMenu: [10, 100, 200,500,1000,2000],
                dom: 'Bfrltip',
                "columns": [
                    {
                        data: "created_at",
                        title: "Entry Date"
                    },
                    {
                        data: "platform",
                        title: "Platform"
                    },
                    {
                        data: "category",
                        title: "Category"
                    },
                    {
                        data: "feature",
                        title: "Feature"
                    },
                    {
                        data: "keyz",
                        title: "Key"
                    },
                    {
                        data: "textz",
                        title: "Default Text"
                    },
                    {
                        data: "english",
                        title: "English"
                    },
                    {
                        data: "pidgin",
                        title: "Pidgin"
                    },
                    {
                        data: "french",
                        title: "French"
                    },
                    {
                        data: "spanish",
                        title: "Spanish"
                    },
                    {
                        data: "swahili",
                        title: "Swahili"
                    },
                    {
                        data: "arabic",
                        title: "Arabic"
                    },
                    {
                        data: "updated_at",
                        title: "Updated"
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return '<button class="btn btn-sm btn-success view-btn">Details</button>';
                        },
                        orderable: false,
                        searchable: false
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

        $('#translations').on('click', '.view-btn', function() {
            let rowData = table.row($(this).parents('tr')).data();

            console.log('Customer data',rowData)

             $('#ref').val(rowData.id)
             $('#platform').val(rowData.platform)
             $('#category').val(rowData.category)
             $('#feature').val(rowData.feature)
             $('#key').val(rowData.keyz)
             $('#text').val(rowData.textz)
             $('#english').val(rowData.english)
             $('#pidgin').val(rowData.pidgin)
             $('#french').val(rowData.french)
             $('#spanish').val(rowData.spanish)
             $('#swahili').val(rowData.swahili)
             $('#arabic').val(rowData.arabic)

        });

        $('#frmTranslation').submit(function(evt){
            evt.preventDefault();

            $.post({
                url: `/api/translations/${$('#ref').val()}`, // <-- your Laravel route
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // important for Laravel
                    platform: $('#platform').val(),
                    category: $('#category').val(),
                    feature: $('#feature').val(),
                    key: $('#key').val(),
                    text: $('#text').val(),
                    english: $('#english').val(),
                    pidgin: $('#pidgin').val(),
                    french: $('#french').val(),
                    spanish: $('#spanish').val(),
                    swahili: $('#swahili').val(),
                    arabic: $('#arabic').val()
                },
                success: function (response) {
                     $('.alert-dismissible').hide();
                        $('#alertSuccess').text(response.message);
                        $('#alertSuccess').show();
                },
                error: function (xhr) {
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
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                @include('components.translation-form')
            </div>

            <div class="col-md-8">
                @include('components.translation-list')
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
