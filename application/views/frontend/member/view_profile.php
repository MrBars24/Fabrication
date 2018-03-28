<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <!-- <pre>
            <?php var_dump($user) ?>
        </pre> -->
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>

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
                                            <button class="btn btn-secondary" data-toggle="modal" data-target=".modal-invite-to-job">Invite to Job</button>
                                    <?php endif;?>
                                </div>
                                <center class="m-t-30"> <img src="<?= (auth()->user_details->avatar == '')? base_url().'assets/images/icon_profile.jpg': auth()->user_details->avatar ?>" class="img-circle" width="150">
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
                                                    <h3 class="font-weight-bold text-info  mb-1"><?= (!isset($user->my_winbid)) ? "0" : $user->my_winbid ?></h3>
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
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#job" role="tab" aria-selected="false">Job</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#hired" role="tab" aria-selected="false">Hired Job</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Profile</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#portfolio" role="tab" aria-selected="false">Portfolio</a> </li>
                                <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Settings</a> </li> -->
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- Overview panes -->
                                <?php $this->load->view('frontend/partials/profile_tab_pane/overview'); ?>
                                <!-- JOB panes -->
                                <?php $this->load->view('frontend/partials/profile_tab_pane/job_post'); ?>
                                <!-- Hired panes -->
                                <?php $this->load->view('frontend/partials/profile_tab_pane/hired_job'); ?>
                                <!-- Profile panes -->
                                <?php $this->load->view('frontend/partials/profile_tab_pane/profile'); ?>
                                <!-- Portpolio panes -->
                                <?php $this->load->view('frontend/partials/profile_tab_pane/portpolio'); ?>

                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;"><div class="slimscrollright" style="overflow: hidden; width: auto; height: 100%;">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div><div class="slimScrollBar" style="background: rgb(220, 220, 220); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>


<!-- View Project Modal -->
<?php  $this->load->view('frontend/partials/view_portfolio_modal') ?>
<!-- End of View Project Modal -->

<!-- Invite to Job -->
<?php  $this->load->view('frontend/partials/invite_to_job_modal') ?>
<!-- End of Invite to Job -->
