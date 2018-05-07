<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="current" content="<?=date('Y-m-d H:i:s')?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/logo_favicon.png">
    <title>E-fab Market online - E-fab Market</title>

    <link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/default/css/style.css">
    <link rel="stylesheet" href="/assets/default/css/colors/blue.css">
    <link rel="stylesheet" href="/assets/plugins/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="/assets/default/css/custom/global.css">

    <?php if(isset($additional_css)){
        foreach($additional_css as $css){
            echo link_tag($css);
        }
    } ?>
</head>


<body class="fix-header card-no-border logo-center <?php echo isset($additional_data['body_class']) ? $additional_data['body_class'] : '' ?>">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">

                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url(); ?>">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="/assets/images/e-fab-logo_2small.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="/assets/images/e-fab-logo_2small.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- dark Logo text -->
<!--                            <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />-->
                            <!-- Light Logo text -->
<!--                            <img src="../assets/images/small-logo-text.png" class="light-logo" alt="homepage" />-->
                         </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <!-- <?= form_open('search/searchresult' , array('method' => 'POST')) ?>
                    <div class="input-group search-form">
                        <input type="text" class="form-control border border-light bg-light" name="search" placeholder="Search for Jobs, Fabricator">
                        <span class="input-group-append"><button type="submit" class="btn btn-success input-group-addon text-white"><i class="fa fa-search"></i></button> </span>
                    </div>
                    <?= form_close() ?> -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="#"><i class="mdi mdi-menu"></i></a> </li>

                        <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <?= form_open('search/all' , array('class'=>' app-search','method'=>'GET')) ?>
                                <input type="text" class="form-control" placeholder="Search Job List" name="q"> <a class="srh-btn"><i class ="ti-close"></i></a>
                            <?= form_close() ?>
                        </li>
                         <!--<li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                            <div class="dropdown-menu scale-up-left">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-outline-inverse">
                                            <div class="card-header text-center">
                                                <h2 class="m-1 text-white">e-fab Steel Fabrication Supply Chain</h2>
                                                <p class="m-0 text-white">Lorem Lorem</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex">
                                        <div class="card col-6 px-0">
                                            <div class="card-body">
                                                <h5 class="m-0 text-center">Project Post</h5>
                                                <hr>
                                                <ul class="list-unstyled">
                                                    <?php for($i=0; $i<4; $i++): ?>
                                                            <li class="media">
                                                                <div class="media-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-9 d-flex flex-column">
                                                                            <h4 class="mt-0 mb-0 font-weight-bold">fIRST TEST TODAY</h4>
                                                                            <small class="text-muted time">Budget: <span class="mt-0 mb-0 text-dark font-weight-bold">$100 - $200</span></small>
                                                                            <small class="text-muted time">Tonnes: <span class="mt-0 mb-0 text-dark font-weight-bold">10</span></small>
                                                                            <small class="text-muted time">Category: <span class="mt-0 mb-0 text-dark font-weight-bold">Architecture</span></small>
                                                                        </div>
                                                                        <div class="col-sm-3 text-right">

                                                                        <small class="">Bid</small>
                                                                            <h4 class="amount">6000</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                    <?php endfor; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card col-6 px-0 ">
                                            <div class="card-body">
                                                <h5  class="m-0 text-center">Construction Professional</h5>
                                                <hr>
                                                <?php for($i=0; $i<4; $i++): ?>
                                                <div class="d-flex flex-row comment-row border p-0 mb-1">
                                                    <div class="p-2"><span class="round"><img src="../assets/images/users/1.jpg" alt="user" width="50"></span></div>
                                                    <div class="comment-text w-100">
                                                        <h5>James Anderson</h5>
                                                        <p class="mb-1 m-t-10">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry.</p>
                                                    </div>
                                                </div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0 d-flex align-items-center">
                        <?php if(isset($_SESSION['user']) and $_SESSION['dashboard'] == 'hire'){ ?>
                        <div class="btn-group">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-users"></i>
                                 Hire</a>
                                 <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?php echo base_url('work') ?>">Work</a>
                                  </div>
                            </li>
                        </div>
                        <?php }elseif(isset($_SESSION['user']) and $_SESSION['dashboard'] == 'work'){ ?>
                        <div class="btn-group">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-user"></i>
                                 Work</a>
                                 <div class="dropdown-menu">
                                    <a class="dropdown-item" href="<?php echo base_url('hire') ?>">Hire</a>
                                  </div>
                            </li>
                        </div>
                        <?php }?>
                    </ul>
                    <ul class="navbar-nav my-lg-0 d-flex align-items-center">
                        <?php if(isset($_SESSION['user'])): ?>
                            <?php $this->load->view('frontend/partials/header/notification')?>
                        <?php endif; ?>

                        <?php if(!isset($_SESSION['user'])): ?>

                          <?php if((get_current_endpoint() == 'login-register')): ?>
                          <?php else: ?>
                                <li class="nav-item mx-1">
                                    <a href="#" class="m-t-10 text-white" data-toggle="modal" data-target="#login" >Login</a>
                                </li>
                                <li class="nav-item mx-3">
                                    <a href="#" class="btn btn-success text-white" data-toggle="modal" data-target="#signupModal" data-whatever="@getbootstrap">Signup</a>
                                </li>
                          <?php endif; ?>

                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= avatar();?>" alt="user" class="profile-pic" /></a>
                                <div class="dropdown-menu dropdown-menu-right scale-up">
                                    <ul class="dropdown-user">
                                        <li>
                                            <div class="dw-user-box">
                                                <div class="u-img"><img src="<?= avatar(); ?>" alt="user"></div>
                                                <div class="u-text">
                                                    <h4><?= $_SESSION['user']->firstname ?> <?= $_SESSION['user']->lastname ?></h4>
                                                    <p class="text-muted"><?= $_SESSION['user']->email ?></p><a href="<?= base_url('members/' . $_SESSION['user']->id ); ?>" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                            </div>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?= base_url('settings'); ?>"><i class="ti-settings"></i> Settings</a></li>
                                        <li><a href="<?= base_url('logout'); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->

                <?php get_nav(get_user_type()); ?>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================z`================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <?= $content ?>
            <!-- Footer -->
            <?php if(!isset($error)): ?>
				<?php $exclude = array('work','hire');
					if(!in_array(get_current_endpoint(),$exclude)):
				?>
                <?php $this->load->view('frontend/partials/footer') ?>
				<?php endif; ?>
            <?php endif; ?>
            <!-- End of Footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <div class="modal fade bs-example-modal-lg" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold" id="exampleModalLabel1">Register</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <?= form_open('register/member', array('class'=> 'form-exp popup')); ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-5 border-right">
                                    <h3 class="font-weight-bold mt-3 font-13"> Create Account </h3>
                                    <p>Register and complete your profile to gain access to thousands of online jobs.</p>
                                    <ul style="line-height:1.5">
                                      <li>No registration fee.</li>
                                      <li>e-fab online certifications.</li>
                                      <li>Hundreds of new jobs every day.</li>
                                      <li>Negotiate a price and start work instantly!</li>
                                    </ul>
                                    <div class="col-xs-12 mt-5 text-center">
                                        <div class="">
                                            <h4 class="text-dark font-weight-bold">Register with Social Media</h4>
                                        </div>
                                        <div class="social">
                                            <a href="javascript:void(0)" class="btn  btn-facebook btn-facebook-signup" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                            <a href="#" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <h3 class="font-weight-bold mt-3 font-13"> Your New Account Details </h3>

                                    <div class="register-message">
                                    </div>



                                    <div class="row p-1">
                                        <div class="col-6 form-group">
                                            <input id="firstname-focus" required type="text" class="form-control" placeholder="First name" name="firstname">
                                        </div>
                                        <div class="col-6 form-group">
                                            <input type="text" required class="form-control" placeholder="Last name" name="lastname">
                                        </div>
                                        <div class="col-12 form-group">
                                            <input type="text" required class="form-control" placeholder="Username" name="username">
                                        </div>
                                        <div class="col-12 form-group">
                                            <input type="email" required class="form-control" placeholder="Email Address" name="email">
                                        </div>
                                        <div class="col-6 form-group">
                                            <input type="password" required class="form-control" placeholder="Password" name="pwd">
                                        </div>
                                        <div class="col-6 form-group">
                                            <input type="password" required class="form-control" placeholder="Re-Type Password" name="rpwd">
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="checkbox checkbox-success">
                                            <input id="chk-terms" type="checkbox" name="terms">
                                            <label for="chk-terms">I accept the Terms and Conditions </label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="checkbox checkbox-success">
                                            <input id="chk-offers" type="checkbox">
                                            <label for="chk-offers">I want to receive personalized offers by your site</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="checkbox checkbox-success">
                                            <input id="chk-partners" type="checkbox">
                                            <label for="chk-partners">Allow partners to send me personalized offers and related services</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Sign up</button>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>

        <div class="modal fade " id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold" id="exampleModalLabel1">Sign In</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <?= form_open('login', array('id'=> 'form-login')); ?>
                    <div class="row mt-4 alert-login-message">

                    </div>
                        <div class="modal-body">
                            <h3 class="box-title m-b-20"></h3>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="">Email Address or Username</label>
                                    <input class="form-control" id="username-focus" type="text" data-target-error-text="#username-error" required="" name="username">
                                    <div class="help-block" hidden>
                                        <ul role="alert">
                                            <li id="username-error"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="">Password</label>
                                    <input class="form-control" type="password" data-target-error-text="#password-error" required="" name="pwd">
                                    <div class="help-block" hidden>
                                        <ul role="alert">
                                            <li id="password-error"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 font-14">
                                    <div class="checkbox checkbox-primary pull-left p-t-0">
                                        <input id="remember-signup" type="checkbox">
                                        <label > Remember me </label>
                                    </div> <a href="/forgot-password" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a> </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info  btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                    <div class="social">
                                        <a href="#" class="btn btn-facebook btn-facebook-login" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                        <a href="#" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                                        <!-- <div class="g-signin2" data-onsuccess="onSignIn"></div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-12 text-center">
                                    <div>Don't have an account? <a href="/login-register" class="text-info m-l-5"><b>Sign Up</b></a></div>
                                </div>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript Libraries -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://apis.google.com/js/api:client.js"></script>
    <script src="/assets/plugins/jquery/jquery.min.js" deferred></script>
    <script src="/assets/plugins/bootstrap/js/popper.min.js" ></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js" ></script>
    <script src="/assets/default/js/jquery.slimscroll.js" ></script>
    <script src="/assets/default/js/waves.js" ></script>
    <script src="/assets/default/js/sidebarmenu.js" ></script>
    <script src="/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js" ></script>
    <script src="/assets/plugins/sparkline/jquery.sparkline.min.js" ></script>
    <script src="/assets/plugins/toastr/build/toastr.min.js" ></script>
    <script src="/assets/plugins/pusher/pusher.min.js"></script>
	<script src="/assets/global.js" deferred></script>
    <script src="/assets/default/js/custom.min.js" ></script>
    <script src="/assets/plugins/styleswitcher/jQuery.style.switcher.js" ></script>
    <script src="/assets/fb.js" ></script>
    <script src="/assets/default/custom/js/login.js" ></script>
    <!--<script src="/assets/default/custom/js/exp-reg.js" ></script>-->
    <script src="/assets/default/custom/js/notification.js" ></script>
    <script src="/assets/plugins/moment/moment.js" ></script>
    <script src="/assets/default/js/scrollify.js" ></script>

    <?php if(isset($add_js)){
          foreach($add_js as $js){ ?>
            <script src="<?= $js; ?>"></script>
    <?php }
        }
        if(isset($extra_js)){
          ?><script><?php
          echo $extra_js;
          ?></script><?php
        }
    ?>
</body>
</html>
