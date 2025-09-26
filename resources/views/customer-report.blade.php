@extends('layouts.app')
@section('title', 'Customer Report')
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
        $('#customer-report').DataTable({
            "processing": true,
                "serverSide": true, // enables server-side processing
                "ajax": {
                    "url": "{{ route('api.customers.index') }}", // 🔥 your backend endpoint here
                    "type": "GET", // or POST if your API expects it
                    "dataSrc": "data" ,// adjust based on your API JSON structure,
                    data: function (d) {
                        // Add your extra params here
                        d.d_from = $('#d_from').val();
                        d.d_to = $('#d_to').val();
                    }
                },
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "order": [
                    [0, "desc"]
                ],

                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search admins list..."
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
                        data: "birthCountry",
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
                        data: "gender",
                        title: "Gender"
                    },
                    {
                        data: "postcode",
                        title: "GP-GPS Code"
                    },
                    {
                        data: "addressLine1",
                        title: "Address"
                    },
                    {
                        data: "dob",
                        title: "Date of Birth"
                    },
                    {
                        data: "addressLine1",
                        title: "District"
                    },
                    {
                        data: "region",
                        title: "Region"
                    },
                    {
                        data: "birthCountry",
                        title: "Country"
                    },
                    {
                        data: "idNumber",
                        title: "ID Number"
                    },
                    {
                        data: "status",
                        title: "Status"
                    },

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

        $('#frmGenerateReport').submit(function(evt){
             evt.preventDefault();
             $('#customer-report').DataTable().ajax.reload()
        })
    });
</script>
@endsection
@section('content')
<div class="row mb-3">
  <div class="col-md-12">
    <div class="card card-success card-outline">
      <div class="card-body">
        <form id="frmGenerateReport" role="form" method="post" action="#">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="d_from">From</label>
                <input type="date" name="d_from" required class="form-control" id="d_from">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="d_to">To</label>
                <input type="date" name="d_to" required class="form-control" id="d_to">
              </div>
            </div>

            <!-- Uncomment if you want transaction type -->
            <!--
            <div class="col-md-3">
              <div class="form-group">
                <label for="trnx_Type">Transaction Type</label>
                <select class="form-control" required id="trnx_Type" name="trnx_Type">
                  <option value="MT-MOMO">MoMo</option>
                  <option value="MT-BANK">Bank Transfer</option>
                  <option value="MT-BILL">Billers</option>
                </select>
              </div>
            </div>
            -->

            <div class="col-md-4">
              <div class="form-group">
                <label for="">&nbsp;</label>
                <button type="submit" class="btn btn-primary w-100" name="filtered_transactions">
                  Generate Report
                </button>
              </div>
            </div>
          </div><!-- /.row -->
        </form>
      </div>
    </div>
  </div>
</div>

@include('components.customer-list-table')
@endsection
