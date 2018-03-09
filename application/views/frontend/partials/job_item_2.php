    <!-- Job List Item -->
    <li class="list-group-item pt-4 pb-1">
        <div class="d-flex justify-content-between">
            <div>
            <h4 class="mb-0"><a href="<?php echo base_url('jobs/1') ?>" class="text-dark">Looking for Steel Fabricators in Silicon Valley</a></h4>
                <h6 class="text-muted mt-2">Posted 1 hour ago - 25 Bids</h6>
            </div>
            <div>
                <button class="btn btn-sm btn-circle"><i class="fa fa-bookmark"></i></button>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 mr-0 col-lg-9">
                <span class="badge badge-secondary px-2 py-1">Commercial</span>
                <h6 class="text-dark mt-3 mb-3">
                <span class="mb-1">Location: Laguna, Philippines</span> | <span class="mb-1">Budget: $100, 000</span> | <span class="mb-1">Approx. Tonnes: 20k</span>
                </h6>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus doloribus ea temporibus quibusdam officia nostrum consectetur adipisicing elit..</p>

                <div>
                    <small>Fabricator:</small>
                    <div class="d-flex justify-content-between">
                         <h6 class="font-weight-bold"><a href="<?= base_url('members/1'); ?>" class="text-dark">Company Name</a></h6>
                        <small class="font-weight-light text-muted"><i class="fa fa-check text-info"></i> Account Verified</small>
                    </div>

                    <div class="d-flex justify-content-start">
                        <!-- Rating Average -->
                            <?php $this->load->view('frontend/partials/rating_stars_full') ?>
                            <span class="text-muted ml-1">(12 reviews)</span>
                        <!-- End of Rating Average -->
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <img src="https://thelogocompany.net/wp-content/uploads/2016/10/main_dlugos.jpg" alt="" class="img-fluid">
                <a href="<?= base_url('jobs/proposal/1') ?>" class="btn btn-success btn-block" target="_blank">Bid Now</a>
            </div>
        </div>

        <div>
            <ul class="list-style-type-none d-flex d-row justify-content-between mt-2">
                <li>
                    <h6 class="text-muted"></h6>
                </li>
                <li>
                    <h6 class="text-muted"></h6>
                </li>
            </ul>
        </div>
    </li>
    <!-- End of Job List Item -->
