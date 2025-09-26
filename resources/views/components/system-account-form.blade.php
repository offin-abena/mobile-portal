 <form id="frm_admin_user" role="form" method="post" action="#">
     <div class="card card-success card-outline">
         <div class="card-header">
             <h3 class="card-title">Add New/Update System Account</h3>
         </div>
         <div class="card-body">
             @csrf
             <div class="form-group mb-2">
                 <label for="phoneNum">Phone Number</label>
                 <input type="number" minlength="10" name="phoneNum" required class="form-control" id="phoneNum" placeholder="Eg. 0XXXXXXXXXX">
             </div>
             <div class="form-group mb-2">
                 <label for="password">Password</label>
                 <input type="password" name="password" class="form-control" id="password" >
             </div>
             <div class="form-group mb-2">
                 <label for="c_password">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="c_password" >
             </div>
             <div class="form-group mb-2">
                  <label for="fullName">Full Name</label>
                                <input type="text" name="fullName" required class="form-control" id="fullName" >
             </div>
             <div class="form-group mb-2">
                  <label for="accountType">Account Type</label>
                                <select class="form-control" required id="accountType" name="accountType" >
                                    <option value="">Select Account Type</option>
                                    <option value="2">System</option>
                                    <option value="3">Agent</option>
                                </select>
             </div>
             <div class="form-group mb-2">
                <label for="country">Country</label>
                                <select class="form-control" id="country" name="country" required>
                                    <option value="">Select Country</option>
                                    <option value="GH">Ghana</option>
                                </select>
             </div>

         </div>

         <div class="card-footer">
             <button type="submit" class="btn btn-success" name="add_superAgent">Save Account</button>
         </div>
     </div>
 </form>
