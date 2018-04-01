<section class="home-hero position-relative py-5">
    <div class="container-fluid">
        <div class="content py-5 py-xs-0">
            <div class="row h-100 d-flex align-items-stretch">
                <div class="col-sm-10 offset-1 text-center d-flex justify-content-center flex-column align-items-center">
                    <h2 class="font-weight-bold text-white title">The world’s leading online market <br class="d-sm-none">for steel fabrication projects.</h2>
                    <div class="input-group mt-4 search-form">
                        <input type="text" class="form-control border border-white" placeholder="Search for Jobs, Fabricator, Experts">
                        <span class="input-group-append"><button class="btn btn-success input-group-addon text-white"><i class="fa fa-search"></i></button></span>
                    </div>
                </div>
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
                            <a href="<?php echo base_url('jobs/category/' . $industry->name) ?>">
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
                        <h2 class="font-weight-bold text-white font-size-4em">453</h2>
                        <h6 class="text-white text-capitalize">Expert Shop Detailers</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm px-sm-5 mb-2">
                <div class="efab-shape mx-auto">
                    <div class="inner-content">
                        <h2 class="font-weight-bold text-white font-size-4em">99</h2>
                        <h6 class="text-white text-capitalize">Active Fabricators</h6>
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
        <?php foreach(range(0, 2) as $i): ?>
            <!-- Job Post Item -->
                <li class="list-group-item border-0 py-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="data:image/png;base64,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" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <h5 class="font-weight-bold mb-1">Regis Hollywood Aged Care</h5>
                                        <h6 class="text-italic text-truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum cumque distinctio earum accusamus excepturi quidem.</h6>
                                        <p class="text-secondary mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo nisi itaque, corrupti aspernatur recusandae sapiente laborum ipsam ex in natus consectetur, ducimus impedit vel repellendus eaque modi? Deleniti, assumenda modi laborum repudiandae tempore sint asperiores incidunt. Voluptate perspiciatis veniam doloribus?</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="d-flex justify-content-between mt-md-5 pt-2 mt-sm-0">
                                    <div class="">
                                        <small class="font-weight-bold">RATING</small>
                                    </div>
                                    <div class="">
                                        <ul class="d-flex flex-row list-style-type-none mb-0">
                                            <li><a href="#" class="text-success mr-1"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#" class="text-success mr-1"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#" class="text-success mr-1"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#" class="text-success mr-1"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#" class="text-success"><i class="fa fa-star"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <small class="font-weight-bold">JOBS POSTED</small>
                                    </div>
                                    <div class="">
                                        <h6 class="font-weight-bold text-dark">25</h6>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <small class="font-weight-bold">PORTFOLIO & SAMPLES</small>
                                    </div>
                                    <div class="">
                                        <h6 class="font-weight-bold text-dark">62</h6>
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
                    <form class="contact-form m-t-10" action="/submit-contact-us" method="POST">
                        <div class="form-group">
                            <label>Name <span class="help"> e.g. "George deo"</span></label>
                            <input type="text" name="contactName" class="form-control" value="George deo..." required>
                        </div>
                        <div class="form-group">
                            <label for="example-email">Email <span class="help"> e.g. "example@gmail.com"</span></label>
                            <input type="email" name="contactEmail" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="contactAddress" class="form-control" placeholder="address" required>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="contactSubject" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Message/Comments</label>
                            <textarea name="contactMessage"  class="form-control" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        </div>    
    </div>
</section>
