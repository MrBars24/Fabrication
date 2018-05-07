<style>

.ul-star li a{
    color:#99abb4;
}

.ul-star li:hover ~ li .ratings_stars {
    color: #ddd;
}

.ul-star:hover  li a {
    color: yellow;
}

.ul-star .starstar {
  color: #6c757d;
}

/* prev siblings should be red */
.ul-star:hover .starstar {
  color: #ffc107;
}
.ul-star .starstar:hover,
.ul-star .starstar:hover ~ .starstar {
  color: #6c757d;
}
.stars-outer{
    display: inline-block;
    position: relative;
    font-family: FontAwesome;
    letter-spacing: 3px;
}

.stars-inner {
    position: absolute;
    top: 0;
    left: 0;
    white-space: nowrap;
    letter-spacing: 3px;
    overflow: hidden;
}

.stars-outer::before {
  content: "\f006 \f006 \f006 \f006 \f006";
}

.stars-inner::before {
  content: "\f005 \f005 \f005 \f005 \f005";
  color: #ffb22b;
}
/******/
</style>

<section class="home-hero position-relative py-5">
    <div class="container-fluid">
        <div class="content py-5 py-xs-0">
            <div class="row h-100 d-flex align-items-stretch">
              <?php echo form_open('search/all', array('method' => 'GET')) ?>
                <div class="col-sm-10 offset-1 text-center d-flex justify-content-center flex-column align-items-center">
                    <h2 class="font-weight-bold text-white title">The world’s leading online market <br class="d-sm-none">for steel fabrication projects.</h2>
                      <div class="input-group mt-4 search-form">
                          <input type="text" class="form-control border border-white" name="q" required placeholder="Search for Jobs, Fabricator, Experts">
                          <span class="input-group-append">
                            <button role="submit" class="btn btn-success input-group-addon text-white"><i class="fa fa-search"></i></button>
                          </span>
                      </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</section>

<section class="home-services bg-white py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 offset-2">
                <h3 class="text-center">A platform where steel fabricators, engineers and project
                managers invite professional shop detailing consultants to
                bid on steel fabrication projects.</h3>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-sm-3 text-center">
                <img src="/assets/images/icon_profile.png" alt="Build Your Profile" class="img-fluid blurb-icon">
                <h4 class="font-weight-bold pt-3">Build Your Profile</h4>
                <h6 class="text-muted">Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh
                euismod tincidunt ut laoreet dolore magna
                aliquam erat volutpat.</h6>
            </div>
            <div class="col-sm-3 text-center">
                <img src="/assets/images/icon_engineer.png" alt="Shop Detailing" class="img-fluid blurb-icon">
                <h4 class="font-weight-bold pt-3">Shop Detailing</h4>
                <h6 class="text-muted">Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh
                euismod tincidunt ut laoreet dolore magna
                aliquam erat volutpat.</h6>
            </div>
            <div class="col-sm-3 text-center">
                <img src="/assets/images/icon_list.png" alt="Submit Proposals" class="img-fluid blurb-icon">
                <h4 class="font-weight-bold pt-3">Submit Proposals</h4>
                <h6 class="text-muted">Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh
                euismod tincidunt ut laoreet dolore magna
                aliquam erat volutpat.</h6>
            </div>
            <div class="col-sm-3 text-center">
            <img src="/assets/images/icon_welder.png" alt="Get Hired" class="img-fluid blurb-icon">
                <h4 class="font-weight-bold pt-3">Get Hired</h4>
                <h6 class="text-muted">Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diam nonummy nibh
                euismod tincidunt ut laoreet dolore magna
                aliquam erat volutpat.</h6>
            </div>
        </div>
    </div>
</section>

<section class="popular-categories  py-5">
    <div class="container-fluid">
        <div class="text-center">
            <h2 class="font-weight-bold text-center">Top Categories</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, sint.</p>
        </div>

        <div class="mt-3">
            <?php foreach(array_chunk($top_industries, 4) as $row): ?>
                <div class="row">
                    <?php foreach($row as $industry): ?>
                        <div class="col-sm-3 text-center">
                            <a href="<?php echo base_url('jobs?category=' . $industry->id) ?>">
                                <div class="card">
                                    <div class="layout-content-middle overlay">
                                        <img class="card-img-top img-responsive" src="http://themedesigner.in/demo/admin-press/assets/images/big/img3.jpg" alt="Card image cap">
                                        <div class="content-wrapper text-white">
                                            <span class="content">
                                                <?php echo $industry->total_jobs ?> JOBS
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $industry->display_name?></h4>
                                        <h6 class="card-subtitle"><?php echo $industry->description?></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="home-numbers py-5">
    <div class="container-fluid">
        <div class="text-center">
            <h2 class="text-white font-weight-bold text-center">Last 30 Days of Activity</h2>
        </div>

        <div class="row text-center mt-3">
            <div class="col-sm px-sm-5 mb-2">
                <div class="efab-shape mx-auto">
                    <div class="inner-content">
                        <h2 class="font-weight-bold text-white font-size-4em"><?php echo $summary->last_30_days_new_jobs ?></h2>
                        <h6 class="text-white text-capitalize">New Jobs Posted</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm px-sm-5 mb-2">
                <div class="efab-shape mx-auto">
                    <div class="inner-content">
                        <h2 class="font-weight-bold text-white font-size-4em"><?php echo $summary->last_30_days_new_biddings ?></h2>
                        <h6 class="text-white text-capitalize">New Biddings</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm px-sm-5 mb-2">
                <div class="efab-shape mx-auto">
                    <div class="inner-content">
                        <h2 class="font-weight-bold text-white font-size-4em"><?php echo $summary->last_30_days_new_users ?></h2>
                        <h6 class="text-white text-capitalize">New Active Users</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-recent py-5 bg-white">
    <div class="container-fluid">
       <div class="row">
           <div class="col-sm-3 p-2">
               <h4 class="font-weight-bold"><i class="fa fa-list"></i> Last 3 Jobs by Category</h4>
           </div>
           <div class="col-sm-9">
            <ul class="nav nav-tabs customtab justify-content-end border-bottom-0" id="home-jobs-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link pt-2 p-1 font-weight-bold" data-toggle="tab" href="#home-tab-any" data-category="any" role="tab" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-home"></i></span><span class="hidden-xs-down">All</span></a> </li>
                    <?php foreach($industries as $industry): ?>
                        <li class="nav-item"><a class="nav-link pt-2 p-1 font-weight-bold " data-toggle="tab" href="#home-tab-<?php echo $industry['id'] ?>" data-category="<?php echo $industry['id'] ?>" role="tab" aria-expanded="false"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down text-capitalize"><?php echo $industry['display_name'] ?></span></a> </li>
                    <?php endforeach; ?>
                </ul>
           </div>
       </div>
    </div>

    <div class="tab-content">
        <div class="tab-pane" id="home-tab-any" role="tabpanel" aria-expanded="true">
            <ul class="list-group list-group-flush list-group-striped data-content-list">
            </ul>
        </div>

        <?php foreach($industries as $industry): ?>
            <div class="tab-pane" id="home-tab-<?php echo $industry['id'] ?>" role="tabpanel" aria-expanded="true">
                <ul class="list-group list-group-flush list-group-striped data-content-list">
                </ul>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="container-fluid pt-5">
        <h4 class="font-weight-bold">There’s more than <a href="#" class="text-success">740</a> jobs opened across <a href="#" class="text-success">23</a> categories</h4>
        <a href="<?= base_url('jobs'); ?>" class="btn btn-warning font-weight-bold text-dark mt-2"><span class="align-middle">BROWSE ALL AVAILABLE JOBS</span><i class="fa fa-angle-right fa-2x align-middle ml-2"></i></a>
    </div>
</section>

<section class="home-testimonial">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <div class="efab-shape mt-xs-0 mb-xs-0">
                    <div class="inner-content text-white px-4">
                        <div class="text-center">
                         <i class="fa fa-quote-left text-success fa-4x"></i>
                        </div>

                        <blockquote class="border-0 quote text-dark">
                        “I believe Steel Fabricators will constantlyuse this unique work resource ‘e-fab’ as agreat opportunity to post projects for shop detailers.”
                        </blockquote>
                        <div class="media mb-0 border-0">
                            <img class="mr-3" width="64" src="http://themedesigner.in/demo/admin-press/assets/images/users/2.jpg" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="my-0 font-weight-bold text-dark">John Doe</h5>
                                <small class="font-italic font-weight-bold d-block text-secondary">Business Name</small>
                                <small class="d-block text-secondary">Feb 27, 2018</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-5">
    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-sm-6 p-2">
                <h4 class="font-weight-bold"><i class="fa fa-user"></i> Last 3 Recently Active Client Fabricators</h4>
            </div>
        </div>
    </div>
    <ul class="list-group list-group-flush list-group-striped">
        <?php foreach($top_members as $user): ?>
            <!-- Job Post Item -->
                <li class="list-group-item border-0 py-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?= print_image($user->avatar_thumbnail) ?>" alt="" class="img-fluid img-circle">
                                    </div>
                                    <div class="col-8">
                                        <h5 class="font-weight-bold mb-1"><?= $user->fullname ?></h5>
                                        <h6 class="text-italic text-truncate"><?= $user->overview ?>.</h6>
                                        <p class="text-secondary mt-4"><?= $user->service_description ?></p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="d-flex justify-content-between mt-md-5 pt-2 mt-sm-0">
                                    <div class="">
                                        <small class="font-weight-bold">RATING</small>
                                    </div>
                                    <div class="col-3 d-flex flex-column align-items-center">
                                        <div class="fa stars-outer">
                                            <div class="fa stars-inner" style="width:<?= ($user->star['percentageRating'] > 0) ? $user->star['percentageRating'] : "0" ?>%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <small class="font-weight-bold">JOBS POSTED</small>
                                    </div>
                                    <div class="">
                                        <h6 class="font-weight-bold text-dark"><?= $user->my_posts ?></h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <small class="font-weight-bold">PORTFOLIO & SAMPLES</small>
                                    </div>
                                    <div class="">
                                        <h6 class="font-weight-bold text-dark"><?= $user->portpolio_count ?></h6>
                                    </div>
                                </div>

                                <a href="<?= base_url('members') ?>" class="btn btn-warning text-dark mt-2 py-0"><span class="align-middle">CONTACT DETAILS & MORE</span><i class="fa fa-angle-right fa-2x align-middle ml-2"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
            <!-- End of Job Post Item -->
        <?php endforeach; ?>
    </ul>
    <div class="container-fluid text-center pt-5">
        <a href="<?= base_url('members') ?>" class="btn btn-warning font-weight-bold text-dark mt-2 d-inline-block mx-auto"><span class="align-middle">BROWSE ALL CLIENT FABRICATORS</span><i class="fa fa-angle-right fa-2x align-middle ml-2"></i></a>
    </div>
</section>

<!-- <section class="home-featured bg-white py-5">
    <div class="container-fluid">
        <div id="carousel-home-featured" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-sm-6 d-flex flex-column justify-content-center">
                            <h2 class="font-weight-bold">Lorem ipsum dolor sit amet.</h2>
                            <h6 class="mb-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit enim tenetur voluptatem! Magni, non atque!</h6>
                            <small class="text-muted">Lorem, ipsum.</small>
                            <div class="mt-4">
                                <a href="#" class="btn btn-success d-inline-block px-5">SEE MORE</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <img class="img-responsive" src="../assets/images/big/img3.jpg" alt="First slide">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-sm-6 d-flex flex-column justify-content-center">
                            <h2 class="font-weight-bold">Lorem ipsum dolor sit amet.</h2>
                            <h6 class="mb-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit enim tenetur voluptatem! Magni, non atque!</h6>
                            <small class="text-muted">Lorem, ipsum.</small>
                            <div class="mt-4">
                                <a href="#" class="btn btn-success d-inline-block px-5">SEE MORE</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <img class="img-responsive" src="../assets/images/big/img3.jpg" alt="First slide">
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-sm-6 d-flex flex-column justify-content-center">
                            <h2 class="font-weight-bold">Lorem ipsum dolor sit amet.</h2>
                            <h6  class="mb-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit enim tenetur voluptatem! Magni, non atque!</h6>
                            <small class="text-muted">Lorem, ipsum.</small>
                            <div class="mt-4">
                                <a href="#" class="btn btn-success d-inline-block px-5">SEE MORE</a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <img class="img-responsive" src="../assets/images/big/img3.jpg" alt="First slide">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-home-featured" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon text-success" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-home-featured" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section> -->

<section class="home-brands bg-light py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-8 offset-2 text-center">
                <h2 class="font-weight-bold">e-Fab Partners</h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm">
                <img src="http://www.e-fab.com.au/files/bocad-partner_1419051982jpg" alt="">
            </div>
            <div class="col-sm">
                <img src="http://www.e-fab.com.au/files/acecad_p_1401471557jpg" alt="">
            </div>
            <div class="col-sm">
                <img src="http://www.e-fab.com.au/files/welspun_w2_1401475528jpg" alt="">
            </div>
            <div class="col-sm">
                <img src="http://www.e-fab.com.au/files/strumis_fp_1419051923jpg" alt="">
            </div>
        </div>
    </div>
</section>

<section class="home-contact bg-white py-5">
    <div class="container">
        <div class="text-center mb-3">
            <h2 class="font-weight-bold text-center">Contact Us</h2>
        </div>
            <div class="col-sm-6 offset-3">
                <div class="card card-body ">
                    <h4 class="card-title text-center">Send your comments and suggestions</h4>
                    <?php $this->load->view('frontend/partials/contact_form')?>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
