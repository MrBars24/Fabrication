<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-sm-3" >
            <div class="stickyside is_stuck top-150">
                <h1 class="font-weight-bold">Work</h1>
                <div> 
                <?php if(!isset($_SESSION['user'])): ?>
                    <?php else: ?>
                    <?php if($_SESSION['dashboard'] == 'hire'){ ?>
                        <span><a class="text-mute" style="padding:10px;" href="<?=  base_url(); ?>hire"><i class="mdi mdi-subdirectory-arrow-right"></i>Hire </a></span>
                    <?php }?>
                    <?php endif; ?>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url('jobs/my-jobs') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Active Contracts</h6>
                            <span class="badge badge-pill badge-secondary">1</span>
                        </a>
                        <a href="<?php echo base_url('jobs/bid-history') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Active Biddings</h6>
                            <span class="badge badge-pill badge-secondary">1</span>
                        </a>
                        <a href="<?php echo base_url('jobs/invitations') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Job Invites</h6>
                            <span class="badge badge-pill badge-secondary">1</span>
                        </a>
                    </div>
                </div>
            <h4 class="font-weight-bold">Recent Search</h4>
            <ul>
                <li><a href="<?php echo base_url('jobs') ?>?q=Steel Fab">Steel Fab</a></li>
                <li><a href="<?php echo base_url('jobs') ?>?q=Philippines">Philippines</a></li>
            </ul>
            <h4 class="font-weight-bold">Browse Jobs by Categories</h4>
            <ul>
                <li><a href="<?php echo base_url('jobs') ?>?industry=commercial">Commercial</a></li>
                <li><a href="<?php echo base_url('jobs') ?>?industry=architectural">Architectural</a></li>
                <li><a href="<?php echo base_url('jobs') ?>?industry=mining">Mining</a></li>
                <li><a href="<?php echo base_url('jobs') ?>?industry=oilgas">Oil and Gas</a></li>
                <li><a href="<?php echo base_url('jobs') ?>?industry=other">Other</a></li>
            </ul>
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <!-- Jobs Feeds -->
            <div class="d-flex flex-row-reverse mt-5">
                <div class="form-inline mt-2 mt-md-0 mb-2">
                    <label class="mr-2">Search</label>
                    <input class="form-control frm-search" type="text" placeholder="" aria-label="Search">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold mb-0">Job Feed</h4>
                </div>
                <ul class="list-group list-group-flush pagination-jobs-container">
                    
                </ul>
            </div>
            <div class="container loader-container"></div>
        </div>
            <!-- End of Jobs Feeds -->
        <div class="col-sm-3 ">
            <div class="card stickyside is_stuck top-150">
                <div class="card-body">
                    <a href="<?php echo base_url('settings') ?>" class="float-right" data-toggle="tooltip" title="Edit Profile"><i class="mdi mdi-settings"></i></a>
                    <div class="text-center profile-head">
                        <img src="http://themedesigner.in/demo/admin-press/assets/images/users/3.jpg" alt="" class="img-fluid">
                    </div>
                    <div class="text-center mt-3">
                        <h4 class="font-weight-bold mb-0">John Doe</h4>
                        <h5 class="mb-3">Sydney, Australlia</h5>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: 75%; height:15px;" role="progressbar">75%</div>
                    </div>

                    <div class="d-flex flex-column text-center mt-3">
                        <span><span class="icon-2x font-weight-bold">8</span>/10</span>
                        <span class="text-muted">bids remaining</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
