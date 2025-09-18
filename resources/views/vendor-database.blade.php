@extends('layouts.app')
@section('title', 'Vendors Database')
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
            $('#vendor-list').DataTable({
                "processing": true,
                "serverSide": true, // enables server-side processing
                "ajax": {
                    "url": "{{ route('api.vendors.index') }}", // 🔥 your backend endpoint here
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
                        data: "district",
                        title: "District"
                    },
                    {
                        data: "meteringSystem",
                        title: "Metering System"
                    },
                    {
                        data: "phoneNumber",
                        title: "Phone Number",
                        className: 'dt-nowrap'
                    },
                    {
                        data: "region",
                        title: "Region"
                    },
                    {
                        data: "regionId",
                        title: "Region ID",
                         className: 'dt-nowrap'
                    },
                    {
                        data: "districtid",
                        title: "District ID"
                    },
                    {
                        data: "CMSID",
                        title: "CMSID"
                    },
                    {
                        data: "vendorId",
                        title: "Vendor ID"
                    },
                    {
                        data: "vendorName",
                        title: "Vendor Name"
                    },
                    {
                        data: "vendorStatus",
                        title: "Vendor Status"
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
               <div class="card card-success card-outline shadow-sm">
                        <!-- List of All Payout -->
                        <div class="card-header" style="color:red">List of All Vendors</div>
                        <div class="card-body">
                             <div class="table-responsive">
                            <table class="table table-striped" id="vendor-list">

                                <thead>
                                <tr>
                                    <th>District</th>
                                    <th>Metering System</th>
                                    <th>Phone Number</th>
                                    <th>Region</th>
                                    <th>RegionId</th>
                                    <th>DistrictId</th>
                                    <th>CMSID</th>
									<th>VendorId</th>
									<th>vendorName</th>
									<th>vendorStatus</th>
									{{-- <th>Reference</th> --}}
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
        @if(isset($request->reference_id))
<div class="row">
  <div class="col-md-12">
    <div class="card shadow-sm">
      <!--<div class="card-header">Perform Transaction.</div>-->
      <div class="card-body">
        <form method="post" role="form"
              onsubmit="return confirm('Are you sure you want to perform this transaction');">
            <div class="form-group">

								<div class="row">
            					<div class="col-md-2">
								<label for="transaction_id">&nbsp;&nbsp;Vendor ID</label>
                                <input class="form-control" value="" type="text" style="width:100%" name="vendorId"   class="form-control" required>
								</div>
								<div class="col-md-2">
								<label for="transaction_id">&nbsp;&nbsp;Vendor Name</label>
                                <input class="form-control" value="" type="text" style="width:100%" name="vendorName"   class="form-control" required>
								</div>

								<div class="col-md-2">
								<label for="transaction_id">&nbsp;&nbsp;Region ID</label>
                                <input class="form-control" value="" type="text" style="width:100%" name="regionId"  class="form-control" required>
								</div>

								<div class="col-md-2">
								<label for="transaction_id">&nbsp;&nbsp;District ID</label>
                                <input class="form-control" value="" type="text" style="width:100%" name="districtId"   class="form-control" required>
								</div>

								<div class="col-md-4">
								<label for="transaction_id">&nbsp;</label>
								<input type="submit" class="btn btn-primary" style="width:100%" class="btn btn-primary" name="update_vendor_info" value="Update Vendor Info">
								</div>
								</div>
                            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endif
    </section>
    <!-- /.content -->
@endsection
