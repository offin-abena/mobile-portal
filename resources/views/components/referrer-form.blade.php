 <form id="frmReferrer" role="form" method="post" action="#">
     <div class="card card-success card-outline">
         <div class="card-header">
             <h3 class="card-title">Add/Update Referrer</h3>
         </div>
         <div class="card-body">
             @csrf
             <input type="hidden" name="id" id="id">
             <div class="form-group mb-2">
                 <label for="code">Code</label>
                 <input type="text" class="form-control" name="code" id="code"  required>
             </div>
             <div class="form-group mb-2">
                 <label for="fullname">Name</label>
                 <input type="text" class="form-control" name="fullName" id="fullName" value="{{ old('fullName') }}" required>
             </div>

             <div class="form-group mb-2">
                 <label for="phone">Phone</label>
                 <input type="text" class="form-control" id="phone" name="phone" required>
             </div>

             <div class="form-group mb-2">
                 <label for="email">Email</label>
                 <input type="email" class="form-control" id="email" name="email" required>
             </div>

             <div class="form-group mb-2">
                 <label for="gender">Gender</label>
                 <select class="form-control" name="gender" id="gender" required>
                     <option value="">Select Gender</option>
                     <option value="male">Male</option>
                     <option value="female">Female</option>
                 </select>
             </div>

             <div class="form-group mb-2">
                 <label for="region">Region</label>
                 <select class="form-control" name="region" id="region" required>
                     <option value="">Select Region</option>
                     <option value="greater accra">Greater Accra</option>
                     <option value="ashanti">Ashanti</option>
                     <option value="western">Western</option>
                     <option value="central">Central</option>
                     <option value="volta">Volta</option>
                     <option value="eastern">Eastern</option>
                     <option value="northern">Northern</option>
                     <option value="upper east">Upper East</option>
                     <option value="upper west">Upper West</option>
                     <option value="brong ahafo">Brong Ahafo</option>
                     <option value="western north">Western North</option>
                     <option value="ahafo">Ahafo</option>
                     <option value="bono">Bono</option>
                     <option value="bono east">Bono East</option>
                     <option value="oti">Oti</option>
                     <option value="north east">North East</option>
                     <option value="savannah">Savannah</option>
                 </select>
             </div>
             <div class="form-group mb-2">
                 <label for="referrer_type">Referrer Type</label>
                 <select class="form-control" name="referrer_type" id="referrer_type" required>
                     <option value="">Select Region</option>
                     <option value="internal">Internal</option>
                     <option value="external">External</option>
                 </select>
             </div>
         </div>

         <div class="card-footer">
             <button type="submit" class="btn btn-success">Submit</button>
         </div>
     </div>
 </form>
