<div class="card card-success card-outline">
    <!--<div class="box-header with-border">Perform Transaction.</div>-->
    <div class="card-body">
        <form method="post" role="form" id="frm-search-transaction">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="d_from">From</label>
                        <input type="date" name="d_from" required class="form-control" id="d_from">
                    </div>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="d_to">To</label>
                        <input type="date" name="d_to" required class="form-control" id="d_to">
                    </div>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="trnx_Type">Transaction Type</label>
                        <select class="form-control" required id="trnx_Type" name="trnx_Type">
                            <option value="MT-MOMO">MoMo Credit</option>
                            <option value="MT-BANK">Bank Transfer</option>
                            <option value="MT-BILL">Billers</option>
                            <option value="MT-AIRTIME">Airtime</option>
                            <option value="MT-PULL">MoMo Debit</option>
                            <option value="COLLECTIONS">All Collections</option>
                            <option value="FULFILMENTS">All Fulfilments</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="transaction_id">&nbsp;</label>
                        <input
                        type="submit"
                        style="width:100%"
                        class="btn btn-success"
                        name="filtered_transactions"

                            value="Generate Report">
                    </div>
                </div>
            </div>
    </div>

    </form>
</div>
</div>
