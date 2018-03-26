<div class="row page-titles">
    <div class="col-md-5 align-self-center">

    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Hire</li>
        </ol>
    </div>
    <div class="">
        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <div class="stickyside pt-4">
                <h1 class="font-weight-bold">Hire</h1>
                <div> 
                    <?php if(!isset($_SESSION['user'])): ?>
                        <?php else: ?>
                        <?php if($_SESSION['dashboard'] == 'hire'){ ?>
                            <span><a class="text-mute" style="padding:10px;" href="<?=  base_url(); ?>work"><i class="mdi mdi-subdirectory-arrow-right"></i>Work </a></span>
                        <?php }?>
                    <?php endif; ?>
                </div>
                <a href="<?php echo base_url('/jobs/create') ?>" class="btn btn-success btn-lg btn-block">Post Job</a>
                <!-- <div class="card mt-3">
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
                </div> -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold mb-0">My Active Job Posts <span class="text-muted">(<?=count($active_jobs)?>)</span></h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach($active_jobs as $job): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <a href="<?php echo base_url('jobs/'.$job->id) ?>">
                                    <div>
                                        <h5 class="mb-0"><?=$job->title?></h5>
                                        <small class="text-muted"><?=date_new_format($job->created_at)?></small>
                                    </div>
                                </a>
                                <div>
                                    <span class="badge badge-pill badge-danger"><?=$job->bids?> Bids</span>
                                    <span class="d-block text-right"><a href="<?php echo base_url('jobs/posted/manage/'.$job->id) ?>"><i class="fa fa-cog"></i></a></span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
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
