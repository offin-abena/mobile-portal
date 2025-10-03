<div class="card card-success card-outline">
    <!--<div class="box-header with-border">Perform Transaction.</div>-->
    <div class="card-body">
        <form method="post" role="form">
            @csrf
            <div class="row">
                <div class="col-md-5 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="d_from">From</label>
                        <input type="date" name="d_from" required class="form-control" id="d_from">
                    </div>
                </div>
                <div class="col-md-5 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="d_to">To</label>
                        <input type="date" name="d_to" required class="form-control" id="d_to">
                    </div>
                </div>
                <div class="col-md-2 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="refund_btn">&nbsp;</label>
                        <button id="goBtn" type="button" class="btn btn-success" style="width:100%"
                            name="filtered_transactions">
                             <span class="spinner d-none me-2">
                                <i class="fa fa-spinner fa-spin"></i>
                            </span>
                            Generate Report
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
