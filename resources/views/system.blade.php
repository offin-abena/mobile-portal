@extends('layouts.app')
@section('title', 'System Configuration')
@section('content')
        <div class="row">
            <div class="col-md-6">

                <!-- USSD status -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">USSD Service</div>
                    <div class="card-body">
                        <form id="frmUSSD" class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="ussd_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="ussd_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="ussd_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="ussd_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="USSD" name="serviceType">
                            <button type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>

                <!-- Mobile App status -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Mobile App Service</div>
                    <div class="card-body">
                        <form id="frmMobile" class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="mobile_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="app_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="mobile_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="app_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="APP" name="serviceType">
                            <button  type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>
                <!-- Legacy Quota Purchase -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Legacy Quota Purchase</div>
                    <div class="card-body">
                        <form id="frmLegacyQuota" class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="legacy_quota_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="legacy_quota_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button  type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>
                <!-- Airtime Purchase Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Airtime Purchase Service</div>
                    <div class="card-body">
                        <form id="frmAirtime" class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="airtime_purchase_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="airtime_purchase_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button  type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>
                <!-- TGL Mobile Vendor Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">TGL Mobile Vendor</div>
                    <div class="card-body">
                        <form id="frmTglMobileVendor" class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="tgl_mobile_vendor_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="tgl_mobile_vendor_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button  type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <!-- B-BUS Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">B-BUS Service</div>
                    <div class="card-body">
                        <form id="frmBBus" class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="b_bus_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="hubtel_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="b_bus_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="hubtel_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="HUBTEL" name="serviceType">
                            <button  type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>

                <!-- Brassica Capital Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Brassica Capital Service</div>
                    <div class="card-body">
                        <form id="frmBrassica" class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="brassica_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="brassica_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button  type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>

                <!-- Momo Transfer Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Momo Transfer Service</div>
                    <div class="card-body">
                        <form id="frmMomo" class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="momo_transfer_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="momo_transfer_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button  type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>
                <!-- Bank Transfer Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Bank Transfer Service</div>
                    <div class="card-body">
                        <form id="frmBank" class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="bank_transfer_on" value="ON">
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="bank_transfer_off" value="OFF">
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button  type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>

                <!-- TGL Mobile Vendor Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">TGL Utility App</div>
                    <div class="card-body">
                        <form id="frmTglUtilityApp" class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="tgl_utility_app_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="tgl_utility_app_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button  type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
 <script>
     $(document).ready(function(){
       $.get("{{ route('api.settings.index') }}",function(res){

            if(res.data.allow_bank_transfer_access){
                $('#bank_transfer_on').prop('checked', true).trigger('change')
                $('#bank_transfer_off').prop('checked', false).trigger('change')
            }
            else{
                $('#bank_transfer_on').prop('checked', false).trigger('change')
                $('#bank_transfer_off').prop('checked', true).trigger('change')
            }

            if(res.data.allow_ussd_access){
                $('#ussd_on').prop('checked', true).trigger('change')
                $('#ussd_off').prop('checked', false).trigger('change')
            }
            else{
                $('#ussd_on').prop('checked', false).trigger('change')
                $('#ussd_off').prop('checked', true).trigger('change')
            }

            if(res.data.allow_mobile_access){
                $('#mobile_on').prop('checked', true).trigger('change')
                $('#mobile_off').prop('checked', false).trigger('change')
            }
            else{
                $('#mobile_on').prop('checked', false).trigger('change')
                $('#mobile_off').prop('checked', true).trigger('change')
            }

            if(res.data.allow_legacy_quote_access){
                $('#legacy_quota_on').prop('checked', true).trigger('change')
                $('#legacy_quota_off').prop('checked', false).trigger('change')
            }
            else{
                $('#legacy_quota_on').prop('checked', false).trigger('change')
                $('#legacy_quota_off').prop('checked', true).trigger('change')
            }

            if(res.data.allow_airtime_purchase_access){
                $('#airtime_purchase_on').prop('checked', true).trigger('change')
                $('#airtime_purchase_off').prop('checked', false).trigger('change')
            }
            else{
                $('#airtime_purchase_on').prop('checked', false).trigger('change')
                $('#airtime_purchase_off').prop('checked', true).trigger('change')
            }

            if(res.data.allow_b_bus_access){
                $('#b_bus_on').prop('checked', true).trigger('change')
                $('#b_bus_off').prop('checked', false).trigger('change')
            }
            else{
                $('#b_bus_on').prop('checked', false).trigger('change')
                $('#b_bus_off').prop('checked', true).trigger('change')
            }

            if(res.data.allow_brassica_access){
                $('#brassica_on').prop('checked', true).trigger('change')
                $('#brassica_off').prop('checked', false).trigger('change')
            }
            else{
                $('#brassica_on').prop('checked', false).trigger('change')
                $('#brassica_off').prop('checked', true).trigger('change')
            }

            if(res.data.allow_momo_transfer_access){
                $('#momo_transfer_on').prop('checked', true).trigger('change')
                $('#momo_transfer_off').prop('checked', false).trigger('change')
            }
            else{
                $('#momo_transfer_on').prop('checked', false).trigger('change')
                $('#momo_transfer_off').prop('checked', true).trigger('change')
            }

            if(res.data.allow_tgl_mobile_vendor_access){
                $('#tgl_mobile_vendor_on').prop('checked', true).trigger('change')
                $('#tgl_mobile_vendor_off').prop('checked', false).trigger('change')
            }
            else{
                $('#tgl_mobile_vendor_on').prop('checked', false).trigger('change')
                $('#tgl_mobile_vendor_off').prop('checked', true).trigger('change')
            }

            if(res.data.allow_tgl_utility_app_access){
                $('#tgl_utility_app_on').prop('checked', true).trigger('change')
                $('#tgl_utility_app_off').prop('checked', false).trigger('change')
            }
            else{
                $('#tgl_utility_app_on').prop('checked', false).trigger('change')
                $('#tgl_utility_app_off').prop('checked', true).trigger('change')
            }
       })

       $('#frmUSSD').submit(function(evt){
            evt.preventDefault();
            toggleStatus($('#ussd_on'),'ussd');
       })

       $('#frmMobile').submit(function(evt){
            evt.preventDefault();
            toggleStatus($('#mobile_on'),'mobile');
       })

        $('#frmLegacyQuota').submit(function(evt){
            evt.preventDefault();
            toggleStatus($('#legacy_quota_on'),'legacy_quote');
       })

       $('#frmAirtime').submit(function(evt){
            evt.preventDefault();
            toggleStatus($('#airtime_purchase_on'),'airtime_purchase');
       })

       $('#frmBBus').submit(function(evt){
            evt.preventDefault();
            toggleStatus($('#b_bus_on'),'b_bus');
       })

    //    $('#frmBBus').submit(function(evt){
    //         evt.preventDefault();
    //         toggleStatus($('#b_bus_on'),'mobile');
    //    })

       $('#frmBrassica').submit(function(evt){
            evt.preventDefault();
            toggleStatus($('#brassica_on'),'brassica');
       })

       $('#frmMomo').submit(function(evt){
            evt.preventDefault();
            toggleStatus($('#momo_transfer_on'),'momo_transfer');
       })

       $('#frmBank').submit(function(evt){
            evt.preventDefault();
            toggleStatus($('#bank_transfer_on'),'bank_transfer');
       })

       $('#frmTglMobileVendor').submit(function(evt){
            evt.preventDefault();
            toggleStatus($('#tgl_mobile_vendor_on'),'tgl_mobile_vendor');
       })

       $('#frmTglUtilityApp').submit(function(evt){
            evt.preventDefault();
            toggleStatus($('#tgl_utility_app_on'),'tgl_utility_app');
       })

       function toggleStatus(selector,serviceTag){
            const url="{{route('api.settings.toggle_status')}}"

            $.post(url,{service:serviceTag,state:selector.prop('checked')?1:0,_token:$('input[name="_token"]').val()})
            .done(function(res){
                 $('.alert-dismissible').hide();
                 $('#alertSuccess').text( res.message);
                 $('#alertSuccess').show();

            })
            .fail(function(xhr, status, error) {
                $('.alert-dismissible').hide();
                $('#alertWarning').text(xhr.responseText);
                $('#alertWarning').show();
            });
       }
    })
</script>
@endsection

