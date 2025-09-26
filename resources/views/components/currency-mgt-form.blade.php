<form id="frm_currency_create" role="form" method="post" action="#">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title">Update Exchange Rate</h3>
        </div>
        <div class="card-body">
            @csrf
            <input type="hidden" id="currencyId"  name="currencyId" />
            <div class="form-group">
                <label for="from">Convert From</label>
                <input type="text" name="from" class="form-control" disabled id="from" required
                    value="">
            </div>
            <div class="form-group">
                <label for="to">Convert to</label>
                <input type="text" name="to" class="form-control" disabled id="to" required
                    value="">
            </div>
            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="number" step="any" name="rate" class="form-control" id="rate" required
                    value="">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn-block btn btn-primary" name="update-exchange">Submit</button>
        </div>
    </div>
</form>
