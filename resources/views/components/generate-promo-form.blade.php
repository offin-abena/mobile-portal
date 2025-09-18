 <form role="form" method="post">
     <div class="card card-success card-outline">
         <div class="card-header">
             <h3 class="card-title">Generate Promo Code</h3>
         </div>
         <div class="card-body">
             @csrf
             <div class="form-group mb-2">
                 <label for="amount">Amount</label>
                 <input type="number" min="1" step="any" class="form-control" id="amount" name="amount" required>
             </div>
             <div class="form-group mb-2">
                 <label for="quantity">Quantity</label>
                 <input type="number" min="1" class="form-control" id="quantity" name="quantity" required>
             </div>
             <div class="form-group mb-2">
                 <label for="country">Country</label>

                 <select required class="form-control" id="country" name="country">
                     <option value="">Select Country</option>
                 </select>
             </div>
             <div class="form-group mb-2">
                 <label for="companyRegDate">Start Date</label>
                 <input type="date" name="start_date" id="" class="form-control">
             </div>
             <div class="form-group mb-2">
                 <label for="companyRegDate">Expiring Date</label>
                 <input type="date" name="exp_date" id="" class="form-control">
             </div>
             <div class="form-group mb-2">
                 <label for="phoneNum">Phone Number</label>
                 <input type="text" name="phoneNum" id="phoneNum" class="form-control">
             </div>
         </div>
         <div class="card-footer">
             <button type="submit" class="btn btn-success">Submit</button>
         </div>
     </div>
 </form>
