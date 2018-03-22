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
