<form role="form" method="post">
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Add New Pricing Policy</h3>
        </div>
        <div class="card-body">
            @csrf
            <div class="form-group mb-2">
                <label for="senderGroup">Senders Group</label>
                <select id="senderGroup" class="form-control" name="senderGroup" required>
                    <option value="">Select Senders Group</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->groupName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="recipientGroup">Recipient Group</label>
                <select id="recipientGroup" class="form-control" name="recipientGroup" required>
                    <option value="">Select Recipient Group</option>
                     @foreach ($groups as $group)
                        <option value="{{ $group->id }}">{{ $group->groupName }}</option>
                     @endforeach
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="sendersAccountType">Senders Account Type</label>
                <select id="sendersAccountType" class="form-control" name="sendersAccountType" required>
                    <option value="">Select Sender Account Type</option>
                    @foreach ($accountTypes as $accountType)
                        <option value="{{ $accountType->id }}">{{ $accountType->accountType }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="recipientAccountType">Recipient Account Type</label>
                <select id="recipientAccountType" class="form-control" name="recipientAccountType" required>
                    <option value="">Select Recipient Account Type</option>
                    @foreach ($accountTypes as $accountType)
                        <option value="{{ $accountType->id }}">{{ $accountType->accountType }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="serviceType">Service Type</label>
                <select id="serviceType" class="form-control" name="serviceType" required>
                    <option value="">Select Service</option>
                    <option value="<?=""?>"><?="Prepaid"?></option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="priceType">Price Type</label>
                <select class="form-control" name="priceType" id="priceType" required>
                    <option value="">Select Price Type</option>
                    <option value="ABSOLUTE">ABSOLUTE</option>
                    <option value="PERCENTAGE">PERCENTAGE</option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="price">Price</label>
                <input type="number" step="any" name="price" class="form-control" id="price" required>
            </div>

            <div class="form-group mb-2">
                <label for="senderCountry">Sender Country</label>
                <select id="senderCountry" class="form-control" name="senderCountry" required>
                    <option value="">Select Country Code</option>
                    <option value="gh">Ghana</option>
                    <!--
                    <option value="lr">Liberia USD</option>
                    <option value="lr1">Liberia LRD</option>
                    <option value="us">United States</option>
                    <option value="ag">Antigua and Barbuda</option>
                    -->
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="recipientCountry">Recipient Country</label>
                <select id="recipientCountry" class="form-control" name="recipientCountry" required>
                    <option value="">Select Country Code</option>
                    <option value="gh">Ghana</option>
                    <!--
                    <option value="lr1">Liberia LRD</option>
                    <option value="us">United States</option>
                    <option value="ag">Antigua and Barbuda</option>
                    -->
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="sysCommission">Brassica Commission</label>
                <input type="number" step="any" name="sysCommission" class="form-control" id="sysCommission" required>
            </div>

            <div class="form-group mb-2">
                <label for="senderCommission">Sender Commission</label>
                <input type="number" step="any" name="senderCommission" class="form-control" id="senderCommission" required>
            </div>

            <div class="form-group mb-2">
                <label for="recipientCommission">Recipient Commission</label>
                <input type="number" step="any" name="recipientCommission" class="form-control" id="recipientCommission" required>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn-block btn btn-primary" name="add-service">Add New Service</button>
        </div>
    </div>
</form>
