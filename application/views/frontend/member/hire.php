<div class="container-fluid">
    <div class="row">
        <div>
        <div class="col-sm-4 stickyside is_stuck position-fixed top-150 " style="width: 410px; z-index:2;">
            <h1 class="font-weight-bold">Hire</h1>
            <div> 
                <?php if(!isset($_SESSION['user'])): ?>
                    <?php else: ?>
                    <?php if($_SESSION['dashboard'] == 'work'){ ?>
                        <span><a class="text-mute" style="padding:10px;" href="<?=  base_url(); ?>work"><i class="mdi mdi-subdirectory-arrow-right"></i>Work </a></span>
                    <?php }?>
                <?php endif; ?>
            </div>
            <a href="<?php echo base_url('/jobs/create') ?>" class="btn btn-success btn-lg btn-block">Post Job</a>
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold mb-0">Active Contracts <span class="text-muted">(2)</span></h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="<?php echo base_url('jobs/my-jobs/1') ?>" class="d-block">
                            <h5 class="mb-0 text-truncate">Bulding Repaint</h5>
                        </a>
                        <small>Project Awarded to <a href="<?php echo base_url('/members/2') ?>">John Cena</a></small>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo base_url('jobs/my-jobs/1') ?>" class="d-block">
                            <h5 class="mb-0 text-truncate">Private Road Reblocking</h5>
                        </a>
                        <small>Project Awarded to <a href="<?php echo base_url('/members/2') ?>">James Gunn</a></small>
                    </li>
                </ul>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold mb-0">My Active Job Posts <span class="text-muted">(2)</span></h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <a href="<?php echo base_url('jobs/1') ?>">
                            <div>
                                <h5 class="mb-0">Job Title 1</h5>
                                <small class="text-muted">2 days ago</small>
                            </div>
                        </a>
                        <div>
                            <span class="badge badge-pill badge-danger">12 New Bids</span>
                            <span class="d-block text-right"><a href="<?php echo base_url('jobs/posted/manage/1') ?>"><i class="fa fa-cog"></i></a></span>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <a href="<?php echo base_url('jobs/1') ?>">
                            <div>
                                <h5 class="mb-0">Job Title 2</h5>
                                <small class="text-muted">2 days ago</small>
                            </div>
                        </a>
                        <div>
                            <span class="badge badge-pill badge-danger">12 New Bids</span>
                            <span class="d-block text-right"><a href="<?php echo base_url('jobs/posted/manage/1') ?>"><i class="fa fa-cog"></i></a></span>
                        </div>
                    </li>
                </ul>
            </div>
            </div>
        </div>
        <div class="col-sm-8 offset-4">
            <!-- Experts -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold mb-0">Recommended Shop Detailers</h4>
                    </div>
                    <div class="comment-widgets mb-0">
                        <?php foreach(range(0,5) as $i): ?>
                            <?php $this->load->view('frontend/partials/member_item') ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <!-- End of Experts -->
        </div>
    </div>
</div>



<!-- Invite to Job Modal -->
<?php $this->load->view('frontend/partials/invite_to_job_modal') ?>
<!-- End of Invite to Job Modal -->
