<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="current" content="<?=date('Y-m-d h:i:s')?>">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <title>E-fab Market online - E-fab Market</title>

    <link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/default/css/style.css">
    <link rel="stylesheet" href="/assets/default/css/colors/blue.css">
    <link rel="stylesheet" href="/assets/default/css/custom/global.css">

    <?php if(isset($additional_css)){
        foreach($additional_css as $css){
            echo link_tag($css);
        }
    } ?>
</head>

<body class="fix-header card-no-border logo-center">
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
                            <img src="../assets/images/e-fab-logo_2small.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../assets/images/e-fab-logo_2small.png" alt="homepage" class="light-logo" />
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
                            <?= form_open('search/searchresult' , array('class'=>' app-search')) ?>
                                <input type="text" class="form-control" placeholder="Search Job List"> <a class="srh-btn"><i class ="ti-close"></i></a>
                            <?= form_close() ?>
                        </li>
                         <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                            <div class="dropdown-menu scale-up-left">
                                <ul class="mega-dropdown-menu row">
                                    <li class="col-lg-3 col-xlg-2 m-b-30">
                                        <h4 class="m-b-20">CAROUSEL</h4>
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <div class="container"> <img class="d-block img-fluid" src="../assets/images/big/img1.jpg" alt="First slide"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="../assets/images/big/img2.jpg" alt="Second slide"></div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="../assets/images/big/img3.jpg" alt="Third slide"></div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                        </div>
                                    </li>
                                    <li class="col-lg-3 m-b-30">
                                        <h4 class="m-b-20">ACCORDION</h4>
                                        <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingOne">
                                                    <h5 class="mb-0">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                  Collapsible Group Item #1
                                                </a>
                                              </h5> </div>
                                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high. </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingTwo">
                                                    <h5 class="mb-0">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                  Collapsible Group Item #2
                                                </a>
                                              </h5> </div>
                                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                    <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingThree">
                                                    <h5 class="mb-0">
                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                  Collapsible Group Item #3
                                                </a>
                                              </h5> </div>
                                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                                    <div class="card-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-lg-3  m-b-30">
                                        <h4 class="m-b-20">CONTACT US</h4>
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Enter email"> </div>
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </li>
                                    <li class="col-lg-3 col-xlg-4 m-b-30">
                                        <h4 class="m-b-20">List style</h4>
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> You can give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Forth link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i> Another fifth link</a></li>
                                        </ul>
                                    </li>
                                </ul>
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
                    <li class="nav-item dropdown show">
                            <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-bell"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated slideInDown">
                                <ul>
                                    <li>
                                        <div class="drop-title">
                                        <span class="float-left">
                                            Notifications
                                        </span>
                                        <div class="float-right">
                                            <a href="#"><i class="fa fa-cog"></i></div></a>
                                        <div class="clearfix"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item py-1 px-3">
                                                <div>
                                                    You were invited to the job <a href="<?php echo base_url('jobs/1') ?>">[URGENT] Need 10 Engineers</a>
                                                </div>
                                                <small class="text-muted">2 hours</small>
                                            </li>
                                            <li class="list-group-item py-1 px-3">
                                                <div>
                                                    You won the Bidding for the job <a href="<?php echo base_url('jobs/1') ?>">Looking for expert fabricator in New York</a>
                                                </div>
                                                <small class="text-muted">1 day</small>
                                            </li>
                                            <li class="list-group-item py-1 px-3">
                                                <div>
                                                    Your contract <a href="#">Job title here</a> has been eneded
                                                </div>
                                                <small class="text-muted">1 day</small>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="#"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php if(!isset($_SESSION['user'])): ?>
                                <li class="nav-item mx-1">
                                    <a href="javascript:void(0)" class="m-t-10 text-white" data-toggle="modal" data-target="#login" >Login</a>
                                </li>
                                <li class="nav-item mx-3">
                                    <a href="javascript:void(0)" class="btn btn-success text-white" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Signup</a>
                                </li>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                                <div class="dropdown-menu dropdown-menu-right scale-up">
                                    <ul class="dropdown-user">
                                        <li>
                                            <div class="dw-user-box">
                                                <div class="u-img"><img src="../assets/images/users/1.jpg" alt="user"></div>
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
                <?php $this->load->view('frontend/partials/footer') ?>
            <?php endif; ?>
            <!-- End of Footer -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold" id="exampleModalLabel1">Register</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <?= form_open('register/member', array('id'=> 'form-exp')); ?>
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
                                            <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                            <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <h3 class="font-weight-bold mt-3 font-13"> Your New Account Details </h3>
                                    <div class="row p-1">
                                        <div class="col-6 form-group">
                                            <input type="text" class="form-control" placeholder="Firstname" name="firstname">
                                        </div>
                                        <div class="col-6 form-group">
                                            <input type="text" class="form-control" placeholder="Lastname" name="lastname">
                                        </div>
                                        <div class="col-12 form-group">
                                            <input type="text" class="form-control" placeholder="Username" name="username">
                                        </div>
                                        <div class="col-12 form-group">
                                            <input type="text" class="form-control" placeholder="Email Address" name="email">
                                        </div>
                                        <div class="col-6 form-group">
                                            <input type="password" class="form-control" placeholder="Password" name="pwd">
                                        </div>
                                        <div class="col-6 form-group">
                                            <input type="password" class="form-control" placeholder="Re-Type Password" name="rpwd">
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
                        <div class="modal-body">
                            <h3 class="box-title m-b-20"></h3>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="">Email Address or Username</label>
                                    <input class="form-control" type="text" data-target-error-text="#username-error" required="" name="username">
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
                                    </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-info  btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                    <div class="social">
                                        <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                        <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div class="col-sm-12 text-center">
                                    <div>Don't have an account? <a href="pages-register.html" class="text-info m-l-5"><b>Sign Up</b></a></div>
                                </div>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript Libraries -->
    <script src="<?php echo base_url() ?>/assets/plugins/jquery/jquery.min.js" deferred></script>
    <script src="<?php echo base_url() ?>/assets/plugins/bootstrap/js/popper.min.js" ></script>
    <script src="<?php echo base_url() ?>/assets/plugins/bootstrap/js/bootstrap.min.js" ></script>
    <script src="<?php echo base_url() ?>/assets/global.js" deferred></script>
    <script src="<?php echo base_url() ?>/assets/default/js/jquery.slimscroll.js" ></script>
    <script src="<?php echo base_url() ?>/assets/default/js/waves.js" ></script>
    <script src="<?php echo base_url() ?>/assets/default/js/sidebarmenu.js" ></script>
    <script src="<?php echo base_url() ?>/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js" ></script>
    <script src="<?php echo base_url() ?>/assets/plugins/sparkline/jquery.sparkline.min.js" ></script>
    <script src="<?php echo base_url() ?>/assets/default/js/custom.min.js" ></script>
    <script src="<?php echo base_url() ?>/assets/plugins/styleswitcher/jQuery.style.switcher.js" ></script>
    <script src="<?php echo base_url() ?>/assets/default/custom/js/login.js" ></script>

    <?php if(isset($add_js)){
          foreach($add_js as $js){ ?>
            <script src="<?php echo base_url() . $js; ?>"></script>
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
