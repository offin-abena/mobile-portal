@extends('layouts.app')
@section('title', 'System Configuration')
@section('content')
        <div class="row">
            <div class="col-md-6">

                <!-- USSD status -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">USSD Service</div>
                    <div class="card-body">
                        <form class="d-flex align-items-center gap-3 flex-wrap" method="post">
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
                        <form class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="app_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="app_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="app_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="app_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="APP" name="serviceType">
                            <button type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>
                <!-- Legacy Quota Purchase -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Legacy Quota Purchase</div>
                    <div class="card-body">
                        <form class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="super_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="super_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>
                <!-- Airtime Purchase Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Airtime Purchase Service</div>
                    <div class="card-body">
                        <form class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="super_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="super_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
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
                        <form class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="hubtel_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="hubtel_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="hubtel_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="hubtel_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="HUBTEL" name="serviceType">
                            <button type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>

                <!-- Brassica Capital Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Brassica Capital Service</div>
                    <div class="card-body">
                        <form class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="super_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="super_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>

                <!-- Momo Transfer Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Momo Transfer Service</div>
                    <div class="card-body">
                        <form class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="super_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="super_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>
                <!-- Bank Transfer Service -->
                <div class="card card-success card-outline mb-3 shadow-sm">
                    <div class="card-header">Bank Transfer Service</div>
                    <div class="card-body">
                        <form class="d-flex align-items-center gap-3 flex-wrap" method="post">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="super_on" value="ON" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_on">TURN ON</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="super_off" value="OFF" <?php echo 'checked';?>>
                                <label class="form-check-label" for="super_off">TURN OFF</label>
                            </div>
                            <input type="hidden" value="SUPER" name="serviceType">
                            <button type="submit" class="btn btn-success btn-sm" name="save">SAVE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
