 <form role="form" method="post" action="{{ route('users.index') }}">
     <div class="card card-success card-outline">
         <div class="card-header">
             <h3 class="card-title">Add New User</h3>
         </div>
         <div class="card-body">
             @csrf
             <div class="form-group mb-2">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="form-group mb-2">
                <label for="c_password">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group mb-2">
                <label for="pin">Reset PIN</label>
                <input type="text" class="form-control" name="pin" value="{{ old('pin') }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="fullName">Full Name</label>
                <input type="text" class="form-control" name="fullName" value="{{ old('fullName') }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="phoneNum">Phone Number</label>
                <input type="text" class="form-control" name="phoneNum" value="{{ old('phoneNum') }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="emailadd">E-mail Address</label>
                <input type="email" class="form-control" name="emailadd" value="{{ old('emailadd') }}" required>
            </div>

            <div class="form-group mb-2">
                <label for="role">Role</label>
                <select class="form-control staff_block" required name="role" id="role">
                    <option value="">Select Role...</option>
                    <option value="SYSTEMADMIN" {{ old('role') == 'SYSTEMADMIN' ? 'selected' : '' }}>SYSTEMADMIN</option>
                    <option value="ADMINISTRATOR" {{ old('role') == 'ADMINISTRATOR' ? 'selected' : '' }}>ADMINISTRATOR</option>
                    <option value="VMANAGER" {{ old('role') == 'VMANAGER' ? 'selected' : '' }}>MANAGER</option>
                    <option value="FRONTDESK" {{ old('role') == 'FRONTDESK' ? 'selected' : '' }}>FRONTDESK</option>
                    <option value="ACCOUNTANT" {{ old('role') == 'ACCOUNTANT' ? 'selected' : '' }}>ACCOUNTANT</option>
                    <option value="COMPLIANCE" {{ old('role') == 'COMPLIANCE' ? 'selected' : '' }}>COMPLIANCE</option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="status">Status</label>
                <select class="form-control" required name="status" id="status">
                    <option value="">Select Status...</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>ACTIVE</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>INACTIVE</option>
                </select>
            </div>
         </div>

         <div class="card-footer">
             <button type="submit" class="btn btn-success">Submit</button>
         </div>
     </div>
 </form>
