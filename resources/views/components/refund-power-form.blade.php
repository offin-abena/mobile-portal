<div class="card card-success card-outline">
    <!--<div class="box-header with-border">Perform Transaction.</div>-->
    <div class="card-body">
        <form method="post" role="form"
            onsubmit="return confirm('Are you sure you want to perform this transaction');">
            @csrf
            <div class="row">
                <div class="col-md-5 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="transaction_id">Enter Async ID</label>
                        <input type="text" style="width:100%" name="transaction_id" id="transaction_id"
                            class="form-control" required>
                    </div>
                </div>
                <div class="col-md-5 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="code">Enter Repeat Code</label>
                        <input type="text" style="width:100%" name="code" value="1" id="code"
                            class="form-control" required>
                    </div>
                </div>
                <div class="col-md-2 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="refund_btn">&nbsp;</label>
                        <input type="submit" style="width:100%" class="btn btn-success" id="refund_btn"
                            name="refund_power" value="Refund">
                    </div>
                </div>
            </div>



        </form>
    </div>
</div>
