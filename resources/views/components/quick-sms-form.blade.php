 <form role="form" method="post">
     <div class="card card-success card-outline">
         <div class="card-header">
             <h3 class="card-title">Quick SMS</h3>
         </div>
         <div class="card-body">
             @csrf
             <div class="form-group">
                 <label for="number">Phone Number</label>
                 <input type="text" name="number" id="number" class="form-control" required
                     placeholder="+233240000000">
             </div>
             <div class="form-group">
                 <label for="message">Message</label>
                 <textarea class="form-control" name="message" id="message" required></textarea>
             </div>
         </div>

         <div class="card-footer">
             <button type="submit" class="btn btn-success">Submit</button>
         </div>
     </div>
 </form>
