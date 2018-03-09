<div class="container-fluid">
    <div class="row">
        <!-- Profile -->
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-center profile-head">
                        <img src="http://themedesigner.in/demo/admin-press/assets/images/users/3.jpg" alt="" class="img-fluid">
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h4 class="font-weight-bold mb-0">John Doe</h4>
                            <h5 class="mb-3">Sydney, Australlia</h5>
                        </div>
                        <div>
                            <a href="<?php echo base_url('settings') ?>" data-toggle="tooltip" title="Edit Profile"><i class="mdi mdi-settings"></i></a>
                        </div>
                    </div>
                    
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: 75%; height:15px;" role="progressbar">75%</div>
                       
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="mt-2">
                        <h6>Membership: Basic</h6>
                        <a href="<?php echo base_url('settings/subscription') ?>" class="btn btn-warning btn-sm btn-block">Upgrade</a>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    
                    <h6>Specialize in Steel Fabricating with 30 years of experience</h6>
                    <div class="d-flex flex-column">
                        <span><span class="icon-2x font-weight-bold">8</span>/10</span>
                        <span class="text-muted">bids remaining</span>
                    </div>
                    
                </div>
            </div>
            
            <!-- Work Overview -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">Work Overview</h5>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="#"> 
                            <h6 class="d-inline-block">New Job Invitations: </h6> <span class="badge badge-danger pull-right">19</span>
                        </a>
                    </li> 
                    <li class="list-group-item">
                        <a href="#"> 
                            <h6 class="d-inline-block">Active Biddings: </h6> <span class="badge badge-danger pull-right">5</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End of Work Overview -->
            
        </div>
        <!-- End of Profile -->

        <!-- Dashboard -->
        <div class="col-sm-6">
            <?= form_open('search/searchresult' , array('method' => 'POST')) ?>
                <div class="input-group search-form"> 
                    <input type="text" class="form-control border border-white" name="search" placeholder="Search for Jobs, Fabricator">
                    <span class="input-group-append"><button type="submit" class="btn btn-success input-group-addon text-white"><i class="fa fa-search"></i></button> </span>
                </div>
            <?= form_close() ?>

            <!-- Jobs Feeds -->
                <!-- Tab Pane Jobs -->
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="card-title font-weight-bold mb-0">Job Feed</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php foreach(range(0, 10) as $number): ?>
                                <!-- Job List Item -->
                                    <?php $this->load->view('frontend/partials/job_item_2') ?>
                                <!-- End of Job List Item -->
                            <?php endforeach; ?>
                        </ul>
                    </div>
                
                <!-- End of Tab Pane Jobs -->
            <!-- End of Jobs Feeds -->
        </div>
        
        <!-- Side Menu -->
        
        <div class="col-sm-3">
            <div class="mb-3">
                    <a href="<?php echo base_url('/job/create') ?>" class="btn btn-success btn-block">Post a job</a>
            </div>
            <div class="stickyside">
                
                <!-- <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Quick Links</h4>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href=""></a>   Search</li>
                        <li class="list-group-item">Jobs</li>
                        <li class="list-group-item"><a href="<?php echo base_url('jobs/bid-history')?>" class="d-flex">Active Bids</a></li>
                        <li class="list-group-item"></li>
                    </ul>
                </div> -->
                 <!-- Hiring Overview -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Hiring Overview</h4>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="#"> 
                                <h6 class="d-inline-block">Active Contracts: </h6> <span class="badge badge-default pull-right">1</span>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#"> 
                                <h6 class="d-inline-block">New Bids: </h6> <span class="badge badge-danger pull-right">5</span>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#"> 
                                <h6 class="d-inline-block">New Answered Invitations: </h6> <span class="badge badge-warning pull-right">3</span>
                            </a>
                        </li> 
                    </ul>
                </div>
                <!-- End of Hiring Overview -->
                
                <!-- Posted Projects -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">My Posted Projects</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h6 class="font-weight-bold mb-0"><a href="<?php echo base_url('jobs/1') ?>">Roofing Needed!</a></h6>
                        </li>
                        <li class="list-group-item">
                            <h6 class="font-weight-bold mb-0"><a href="<?php echo base_url('jobs/1') ?>">Rural Development</a></h6>
                        </li>
                        <li class="list-group-item">
                            <h6 class="font-weight-bold mb-0"><a href="<?php echo base_url('jobs/1') ?>">Piping for our new Office</a></h6>
                        </li>
                    </ul>
                </div>
                <!-- End Posted Projects -->
                
                <!-- Popular Searches -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Popular Searches</h4>

                        <div>
                            <a href="#"><span class="badge badge-pill badge-secondary text-white">House</span></a>
                            <a href="#"><span class="badge badge-pill badge-secondary text-white">Road</span></a>
                            <a href="#"><span class="badge badge-pill badge-secondary text-white">Building</span></a>
                            <a href="#"><span class="badge badge-pill badge-secondary text-white">Test</span></a>
                        </div>
                    </div>
                </div>
                
                <!-- Top Fabricators -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Top Experts</h4>
                    </div>
                    <ul class="list-unstyled mb-0">
                            <li class="media mb-0">
                                <img class="mr-2" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161b5b4ee78%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161b5b4ee78%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.84375%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                                <div class="media-body">
                                <h5 class="mt-0">List-based media object</h5>
                                    Lorem ipsum dolor sit amet.
                                </div>
                            </li>
                            <li class="media mb-0">
                                <img class="mr-2" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161b5b4ee78%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161b5b4ee78%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.84375%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                                <div class="media-body">
                                <h5 class="mt-0">List-based media object</h5>
                                    Lorem ipsum dolor sit amet.
                                </div>
                            </li>
                            <li class="media mb-0">
                                <img class="mr-2" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161b5b4ee78%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161b5b4ee78%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.84375%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                                <div class="media-body">
                                <h5 class="mt-0">List-based media object</h5>
                                    Lorem ipsum dolor sit amet.
                                </div>
                            </li>
                        </ul>
                </div>
                <!-- End of Top Fabricators -->
                
            </div>
            
            
        
        
        
        </div>
    </div>
</div>