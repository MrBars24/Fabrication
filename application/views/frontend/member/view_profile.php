<div class="row page-titles">
    <div class="col-md-5 align-self-center">
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
			<li class="breadcrumb-item"><a href="/hire">Hire</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </div>
    <div class="">
        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
    </div>
</div>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <?php if(auth()->id == $this->uri->segment(2)): ?>

						<?php else: ?>
                                <button class="btn btn-success">Contact</button>
                                <button class="btn btn-secondary btn-modal-invite" data-toggle="modal" data-target=".modal-invite-to-job" data-id="<?= $user->id ?>">Invite to Job</button>
                        <?php endif;?>
                    </div>
                    <center class="m-t-30"> <img src="<?= print_image($user->avatar); ?>" class="img-circle" width="150">
                        <h4 class="card-title m-t-10"><?= @$user->fullname ?></h4>
                        <h6 class="card-subtitle text-dark font-weight-bold"><?= @$user->username ?></h6>
                        <ul class="categories list-style-type-none d-block">
                            <?php foreach($skills as $skill): ?>
                                <li class="d-inline-block"><span class="badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1"><?= $skill->title ?></span></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="row text-center justify-content-md-center">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col text-center">
                                        <h3 class="font-weight-bold text-info  mb-1"><?= (!isset($user->my_win_bids)) ? "0" : $user->my_win_bids ?></h3>
                                        <small>PROJECTS WON</small>
                                    </div>
                                    <div class="col text-center">
                                        <h3 class="font-weight-bold text-info  mb-1">99%</h3>
                                        <small>SUCCESS RATE</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col text-center">
                                        <h3 class="font-weight-bold text-info mb-1"><?= (!isset($user->my_posts)) ? "0" : $user->my_posts ?></h3>
                                        <small>PROJECTS POSTED</small>
                                    </div>
                                    <div class="col text-center">
                                        <h3 class="font-weight-bold text-info mb-1">0%</h3>
                                        <small>HIRE RATE</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
                <div>
                    <hr> </div>
                <div class="card-body">
                    <small class="text-muted">Email address </small>
                    <h6><?= @$user->email ? $user->email : "N/A" ?></h6>
                    <small class="text-muted p-t-30 db">Phone</small>
                    <h6><?= @$user->phone ? $user->phone : "N/A" ?></h6>
                    <small class="text-muted p-t-30 db">Address</small>
                    <h6><?= @$user->address ? $user->address : "N/A"?></h6>
                    <small class="text-muted p-t-30 db">Social Profile</small>
                    <br>
                    <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                    <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#overview" role="tab" aria-selected="true">Overview</a> </li>
                    <li class="nav-item"> <a class="nav-link px-2" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Profile</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#portfolio" role="tab" aria-selected="false">Portfolio</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#training" role="tab" aria-selected="false">Training</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#job" role="tab" aria-selected="false">Posted Job</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#hired" role="tab" aria-selected="false">Awarded Job</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#previous" role="tab" aria-selected="false">Previous Job</a> </li>
                    <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Settings</a> </li> -->
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Overview panes -->
                    <?php $this->load->view('frontend/partials/profile_tab_pane/overview'); ?>
                    <!-- Profile panes -->
                    <?php $this->load->view('frontend/partials/profile_tab_pane/profile'); ?>
                    <!-- Portpolio panes -->
                    <?php $this->load->view('frontend/partials/profile_tab_pane/portpolio'); ?>
                    <!-- Training panes -->
                    <?php $this->load->view('frontend/partials/profile_tab_pane/training'); ?>
                    <!-- JOB panes -->
                    <?php $this->load->view('frontend/partials/profile_tab_pane/job_post'); ?>
                    <!-- Awarded panes -->
                    <?php $this->load->view('frontend/partials/profile_tab_pane/hired_job'); ?>
                    <!-- Hired panes -->
                    <?php $this->load->view('frontend/partials/profile_tab_pane/previous_job'); ?>

                </div>
            </div>
        </div>
        <!-- Column -->
        </div>
    </div>


<!-- View Project Modal -->
<?php  $this->load->view('frontend/partials/view_portfolio_modal') ?>
<!-- End of View Project Modal -->

<!-- Invite to Job -->
<?php  $this->load->view('frontend/partials/invite_to_job_modal') ?>
<!-- End of Invite to Job -->
