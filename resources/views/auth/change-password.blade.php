@extends('layouts.app')
@section('title', 'Change Password')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-primary card-outline">
        <div class="card-header">
          Change your password
        </div>
        <form role="form" method="post" action="{{ route('password.update') }}">
             @csrf
          <div class="card-body">
            <div class="mb-3">
              <label for="currentPassword" class="form-label">Current Password</label>
              <input type="password" class="form-control" name="currentPassword" value="{{ old('currentPassword') }}" id="currentPassword" required>
            </div>
            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" minlength="6" class="form-control" value="{{ old('newPassword') }}" name="newPassword" id="newPassword" required>
            </div>
            <div class="mb-3">
              <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
              <input type="password" minlength="6" class="form-control" value="{{ old('newPassword_confirmation') }}" name="newPassword_confirmation" id="confirmNewPassword" required>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" name="changePass" class="btn btn-primary w-100">
              Change Password
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-md-6"><!-- optional column for other content --></div>
  </div>
</section>
<!-- /.content -->
@endsection
