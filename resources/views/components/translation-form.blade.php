 <form role="form" method="post">
     <div class="card card-success card-outline">
         <div class="card-header">
             <h3 class="card-title">Add New User</h3>
         </div>
         <div class="card-body">
             @csrf
             <div class="box box-default">
                 <div class="box-header with-border">Update Selected Entry</div>
                 <div class="box-body">
                     <form role="form" method="post">

                         <div class="row">
                             <div class="col-md-6 mb-2 mb-md-2">

                                 <div class="form-group">
                                     <label for="platform">Platform</label>
                                     <select class="form-control" required id="platform" name="platform">
                                         <option value="mobile">Mobile</option>
                                         <option value="web">Web</option>
                                         <option value="ussd">USSD</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-md-6 mb-2 mb-md-2">
                                 <div class="form-group">
                                     <label for="category">Category</label>
                                     <input type="text" value="" name="category" required class="form-control"
                                         id="category" placeholder="e.g login">
                                 </div>

                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-6 mb-2 mb-md-2">

                                 <div class="form-group">
                                     <label for="feature">Feature</label>
                                     <input type="text" value="" name="feature" required class="form-control"
                                         id="feature">
                                 </div>
                             </div>
                             <div class="col-md-6 mb-2 mb-md-2">
                                 <div class="form-group">
                                     <label for="key">Key</label>
                                     <input type="text" value="" name="key" readonly class="form-control"
                                         id="key">
                                 </div>

                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-6 mb-2 mb-md-2">

                                 <div class="form-group">
                                     <label for="text">Default Text</label>
                                     <input type="text" value="" name="text" required class="form-control"
                                         id="text">
                                 </div>
                             </div>
                             <div class="col-md-6 mb-2 mb-md-2">
                                 <div class="form-group">
                                     <label for="english"> English Text</label>
                                     <input type="text" value="" name="english" required class="form-control"
                                         id="text">
                                 </div>

                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-6 mb-2 mb-md-2">
                                 <div class="form-group">
                                     <label for="pidgin">Pidgin Text</label>
                                     <input type="text" value="" name="pidgin" required class="form-control"
                                         id="text">
                                 </div>
                             </div>
                             <div class="col-md-6 mb-2 mb-md-2">
                                 <div class="form-group">
                                     <label for="french">French Text</label>
                                     <input type="text" value="" name="french" required class="form-control"
                                         id="text">
                                 </div>
                             </div>
                         </div>


                         <div class="row">
                             <div class="col-md-6 mb-2 mb-md-2">
                                 <div class="form-group">
                                     <label for="spanish">Spanish Text</label>
                                     <input type="text" value="" name="spanish" required class="form-control"
                                         id="text">
                                 </div>
                             </div>
                             <div class="col-md-6 mb-2 mb-md-2">
                                 <div class="form-group">
                                     <label for="swahili">Swahili Text</label>
                                     <input type="text" value="" name="swahili" required class="form-control"
                                         id="text">
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-6 mb-2 mb-md-2">

                                 <div class="form-group">
                                     <label for="arabic">Arabic Text</label>
                                     <input type="text" value="" name="arabic" required
                                         class="form-control" id="text">
                                 </div>
                             </div>
                             <div class="col-md-6">
                             </div>
                         </div>

                         <!-- <div class="form-group">
                                <label for="language">Language</label>
                                <select class="form-control" required id="language" name="language" >
                                <option value="<?//=$data['languagez']?>"><?//=$data['english']?></option>
                                    <option value="english">English</option>
                                    <option value="pidgin">Pidgin</option>
                                    <option value="french">French</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="swahili">Swahili</option>
                                    <option value="arabic">Arabic</option>
                                </select>
                            </div> -->

                     </form>
                 </div>
             </div>
         </div>

         <div class="card-footer">
             <button type="submit" class="btn btn-success">Submit</button>
         </div>
     </div>
 </form>
