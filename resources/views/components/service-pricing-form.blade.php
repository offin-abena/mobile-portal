<form role="form" method="post">
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Add New System Account</h3>
        </div>
        <div class="card-body">
            @csrf

            <div class="form-group mb-2">
                <label for="countryCode">Country Code</label>
                <select id="countryCode" class="form-control" name="countryCode" required>
                    <option value="gh">GH</option>
                    <!--
                    <option value="us">US</option>
                    <option value="gb">GB</option>
                    <option value="lr">LR</option>
                    <option value="lr1">LR1</option>
                    <option value="ag">AG</option>
                    -->
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="general">General Services</label>
                <select id="general" class="form-control" name="general" required>
                    <option value="MT-BILL">Bill Payment</option>
                    <option value="MT-BANK">Bank Deposit</option>
                    <option value="MT-MOMO">Mobile Money</option>
                    <option value="MT-AIRTIME">Airtime</option>
                    <!--
                    <option value="MP">Make Payment</option>
                    <option value="CO">Cash Out</option>
                    <option value="BP">Bill Payment</option>
                    <option value="RP">Roaming Payment</option>
                    <option value="WTB">Wallet to Bank</option>
                    <option value="BTW">Bank to Wallet</option>
                    -->
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="serviceName">Service Name</label>
                <input type="text" name="serviceName" value="" class="form-control" id="serviceName" required>
            </div>

            <div class="form-group mb-2">
                <label for="minimum">Minimum Amount</label>
                <input type="number" step="any" name="minimum" value="" class="form-control" id="minimum" required>
            </div>

            <div class="form-group mb-2">
                <label for="maximum">Maximum Amount</label>
                <input type="number" step="any" name="maximum" value="" class="form-control" id="maximum" required>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn-block btn btn-primary" name="add-service">Add New Service</button>
        </div>
    </div>
</form>
