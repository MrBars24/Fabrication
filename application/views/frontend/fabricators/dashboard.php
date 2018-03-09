<div class="container-fuid">
    <div class="container-fluid">
       <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Search Experts</h4>
                        <div class="form-group">
                            <h6 class="font-weight-bold">Industry</h6>
                            <select class="form-control">
                                <option value="" disabled selected>Any</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <h6 class="font-weight-bold">Country</h6>
                            <select class="form-control">
                                <option value="" disabled selected>Any</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <h6 class="font-weight-bold">Min Rating</h6>
                                    <select class="form-control">
                                        <option value="" disabled selected>Any</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <h6 class="font-weight-bold">Jobs Finished</h6>
                                    <input type="number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 class="font-weight-bold">Verified</h6>
                            
                            <input type="checkbox" id="search-expert-verified" name="ver" class="filled-in chk-col-blue-grey" >
                            <label for="search-expert-verified">Show only Verified Accounts</label>

                           
                        </div>

                        <button class="btn btn-success btn-block" type="submit">Search</button>
                    </div>  
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Suggested Shop Detailers</h4>
                    </div>

                    <div class="comment-widgets mb-0">
                        <?php foreach(range(0,5) as $i): ?>
                            <!-- Comment Row -->
                            <div class="d-flex flex-row comment-row">
                                <div class="p-2"><span class="round"><img src="../assets/images/users/1.jpg" alt="user" width="50"></span></div>
                                <div class="comment-text w-100 py-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="font-weight-bold mb-0"><a href="#">Expert Company Name</a></h4>
                                        <span>
                                            <button class="btn btn-success btn-sm">Hire Me</button>
                                        </span>
                                    </div>
                                    <small><span class="text-warning"><i class="fa fa-star"></i> 5.0</span><span class="text-muted m-l-5">( <a href="#"  class="text-muted">15 Reviews</a> )</span></small>
                                    <div class="comment-footer">

                                        <span class="label label-info">Commercial</span>
                                    </div>
                                    <h6 class="d-block mt-2 font-weight-bold">Tag Line Here Lorem ipsum dolor sit amet.</h6>
                                    <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias sed tempore quasi natus vel beatae commodi sint. Expedita iure ipsum optio nemo veniam sed.</h6>
                               </div>
                            </div>
                            <!-- End of Comment Row -->
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
            
            </div>
       </div>
    </div>
</div>