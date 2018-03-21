<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <!-- <pre>
            <?php var_dump($winJob) ?>
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
                                <center class="m-t-30"> <img src="../assets/images/users/5.jpg" class="img-circle" width="150">
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
                                <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="true">Job</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#hired" role="tab" aria-selected="false">Hired Job</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Profile</a> </li>
                                <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Settings</a> </li> -->
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- First Tab MYJOB panes -->
                                <div class="tab-pane active show" id="home" role="tabpanel">
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush">
                                            <?php if($myJob): ?>
                                                <?php foreach($myJob as $job):?>
                                                    <li class="list-group-item">
                                                        <h4 class="font-weight-bold mb-0"><a href="<?php echo base_url("jobs/$job->id") ?>"><?= $job->title ?></a></h4>
                                                        <small class="text-muted"><?= date_new_format($job->created_at) ?></small>
                                                        <!-- <h6 class="mt-3">Client's Rating:</h6> <?php $this->load->view('frontend/partials/rating_stars_full') ?> -->
                                                        <blockquote>
                                                            <?= $job->description ?>
                                                        </blockquote>
                                                        <div class="mt-3">
                                                            <?php if($job->status == 'open'): ?>
                                                                <small>Status</small>
                                                                <h6>Open</h6>
                                                            <?php else: ?>
                                                                <small>Status </small>
                                                                <h6><?= $job->status ?></h6>
                                                            <?php endif; ?>
                                                                <!-- <?php $this->load->view('frontend/partials/rating_stars_short') ?>
                                                                <small><span class="text-muted m-l-5">( <a href="#"  class="text-muted">15 Reviews</a> )</span></small> -->
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li class="list-group-item">
                                                    <h4 class="font-weight-bold text-center mb-0">No Job History</h4>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Second Tab Hired panes -->
                                <div class="tab-pane " id="hired" role="tabpanel">
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush">
                                            <?php if($winJob): ?>
                                                <?php foreach($winJob as $win):?>
                                                    <li class="list-group-item">
                                                        <h4 class="font-weight-bold mb-0"><a href="<?php echo base_url("jobs/$win->job_id") ?>"><?= $win->title ?></a></h4>
                                                        <small class="text-muted"><?= date_new_format($win->accepted_at) ?></small>
                                                        <!-- <h6 class="mt-3">Client's Rating:</h6> <?php $this->load->view('frontend/partials/rating_stars_full') ?> -->
                                                        <blockquote>
                                                            <?= $win->description ?>
                                                        </blockquote>
                                                        <div class="d-flex justify-content-between mt-3">
                                                            <div class="">
                                                                <small>Hired by</small>
                                                                <h6><?= $win->fullname ?></h6>
                                                                    <!-- <?php $this->load->view('frontend/partials/rating_stars_short') ?> -->
                                                                    <!-- <small><span class="text-muted m-l-5">( <a href="#"  class="text-muted">15 Reviews</a> )</span></small> -->
                                                            </div>
                                                            <div class=" mt-3">
                                                                <!-- <div class="like-comm">
                                                                    <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-gavel text-danger"></i> 1 Bids</a>

                                                                    <a href="/jobs/posted/manage/37" class="text-dark m-r-10" data-toggle="tooltip" title="Manage Job"><i class="mdi mdi-settings"></i> Manage</a>
                                                                    <a href="/jobs/" class="text-dark" data-toggle="tooltip" title="View Job"><i class="mdi mdi-eye-outline"></i> View Job</a>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li class="list-group-item">
                                                    <h4 class="font-weight-bold text-center mb-0">No Winning Job</h4>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                 </div>
                                 <!-- <pre>
                                <?php var_dump($myJob) ?>
                            </pre> -->

                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <h4 class="card-title">Description</h4>
                                        <p class="mt-2"><?= @$user->service_description ?></p>
                                        <h4 class="card-title">Fabricating information</h4>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <h6 class="text-muted mb-0">Industry</h6>
                                                <h4 class="font-weight-bold mb-0">Mining</h4>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <h6 class="text-muted mb-0">Years Operating</h6>
                                                <h4 class="font-weight-bold mb-0">25</h4>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <h6 class="text-muted mb-0">Ave. Tones / Month</h6>
                                                <h4 class="font-weight-bold mb-0">75</h4>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <h6 class="text-muted mb-0">Area serviced</h6>
                                                <h4 class="font-weight-bold mb-0">Local</h4>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <h6 class="text-muted mb-0">NC and DSTV processing</h6>
                                                <h4 class="font-weight-bold mb-0">Yes</h4>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <h6 class="text-muted mb-0">Tech. query or RFI system</h6>
                                                <h4 class="font-weight-bold mb-0">Yes</h4>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="d-flex flex-direction-row justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="mb-2">Largest successful project</h6>
                                                        <h4 class="font-weight-bold mb-0">Abbatoir and processing plant<br><span class="font-weight-light">approx. 75 tonne</span></h4>
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold font-size-2em">$7, 000, 000</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-md-12">Full Name</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Password</label>
                                                <div class="col-md-12">
                                                    <input type="password" value="password" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Phone No</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Message</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5" class="form-control form-control-line"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12">Select Country</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div> -->
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
