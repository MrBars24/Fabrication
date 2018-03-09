<div class="container job-view">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="mt-2 mb-0"><strong><?= $viewtrainings->training_name ?></strong></h1>
            <small class="text-muted">Posted 10 hours ago</small>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-sm-8">
            <div class="card">
                <!--
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div>
                                <span class="">New York, US</span>
                            </div>
                            <span class="badge badge-secondary">Commercial</span>
                        </div>
                        <div>
                            <button class="btn default btn-circle"><i class="text-white fa fa-bookmark"></i></button>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between mt-4">
                    
                        <div>
                            <small class="text-muted">Bids</small>
                            <span class="d-block icon-2x">15</span>
                        </div>

                        <div>
                            <small class="text-muted">Budget</small>
                            <span class="d-block icon-2x">$150, 000</span>
                        </div>
                            
                        <div>
                            <small class="text-muted">Status</small>
                            <span class="d-block icon-2x text-primary">OPEN</span>
                        </div>
                    </div>
                </div>
            -->
                <div class="card-body">

                    <h4 class="card-title">Job Description</h4>

                    <div class="description mt-4">
                        <p><?= $viewtrainings->description ?></p>
                    </div>
                    <div class="d-flex flex-row justify-content-end">
                        <small><a href="#" class="text-danger">Report this Job</a></small>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="float-left">
                            <h4 class="card-title">Experts Bidding (15)</h4>
                        </div>
                        <div class="float-right">
                            <select name="" class="form-control">
                                <option value="">Recent</option>
                                <option value="">Lowest First</option>
                                <option value="">Highest First</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                   

                    <ul class="list-unstyled">
                        <?php foreach(range(0, 10) as $i): ?>
                            <li class="media border-0">
                                <img class="mr-3 rounded-circle" src="http://themedesigner.in/demo/admin-press/assets/images/users/8.jpg" width="64" alt="Generic placeholder image">
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <h4 class="mt-0 mb-1 font-weight-bold">Company Name</h4>
                                            <small class="text-muted">10 mins ago</small>
                                        </div>
                                        <div class="col-sm-3 text-right">
                                        <small class="">Bid</small>
                                            <h4>$25,000</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
<!--            data-toggle="modal" data-target=".modal-bid-now"-->
            <a class="btn btn-success btn-lg btn-block" href="<?= base_url('jobs/proposal/1') ?>" target="_blank">Bid Now</a>
<!--            <a class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target=".modal-bid-now">Bid Now</a>-->
            <!-- Fabricator Snapshot -->
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title">About the Fabricator</h4>

                    <div class="row">
                        <div class="col-4">
                            <img src="data:image/png;base64,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" alt="" class="img-fluid">
                        </div>
                        <div class="col-8 pl-0">
                            <h3 class="text-truncate font-weight-bold mb-0">ABC Steel Firm</h3>
                            <small class="text-muted">Client Verified</small>

                            <div class="d-flex flex-column align-items-start mb-3">
                                <span class="badge badge-warning px-3">4.5</span>
                                <ul class="d-flex flex-row list-style-type-none mb-0">
                                    <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                </ul>
                                <small class="text-muted d-block">(17 reviews)</small>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <small class="text-muted">Overview</small>
                        <h4>Lorem ipsum dolor sit amet.</h4>

                        <small class="text-muted">Industry</small>
                        <div>
                            <span class="badge badge-secondary py-2 px-3">Mining</span>
                            <span class="badge badge-secondary py-2 px-4">Commercial</span>
                        </div>

                        <div class="d-flex flex-row justify-content-between mt-3">
                            <div>
                                <small class="text-muted">Jobs Posted</small>
                                <h4>17</h4>
                            </div>
                            <div>
                                <small class="text-muted">Hire Rate</small>
                                <h4>100%</h4>
                            </div>
                            <div>
                                <small class="text-muted">Member Since</small>
                                <h4>Apr 2009</h4>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Fabricator Snapshot -->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-bid-now" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Proposal</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h5 class="font-weight-bold">Bid</h5>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" placeholder="Amount">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted">Client's Budget</small>
                        <h4 class="font-weight-bold text-success m-0">$500,000k</h4>
                    </div>
                </div>
                <div class="form-group">
                    <h5 class="font-weight-bold">Cover Letter</h5>
                    <textarea class="form-control" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect text-left">Submit Bid</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>