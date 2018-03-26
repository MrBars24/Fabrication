<!-- Member Row -->
<div class="col-sm-6">
<!--     <div class="d-flex flex-row card comment-row">
    <div class="p-2"><span class="round"><img src="../assets/images/users/1.jpg" alt="user" width="50"></span></div>
    <div class="comment-text w-100 py-0">
        <div class="d-flex justify-content-between">
            <h4 class="font-weight-bold mb-0"><a href="<?= base_url('members'); ?>">Member Name / Company</a></h4>
            <span>
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target=".modal-invite-to-job">Invite</button>
            </span>
        </div>

        <!-- Rating Average -->
            <!--?php $this->load->view('frontend/partials/rating_stars_short') ?>
            <small>
                <span class="text-muted m-l-5">( <a href="#"  class="text-muted">15 Reviews</a> )</span>
            </small>
        <!-- End Rating Average -->

        <!--div class="mt-2">
            <span class="label label-info">Commercial</span>
        </div>
        <h6 class="d-block mt-2 font-weight-bold">Tag Line Here Lorem ipsum dolor sit amet.</h6>
        <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias sed tempore quasi natus vel beatae commodi sint. Expedita iure ipsum optio nemo veniam sed.</h6>
    </div>
</div>-->

    <div class="card">
        <div class="justify-content-center d-flex px-5 mt-3">
            <img class="card-img-top img-responsive rounded-circle img-thumbnail hire-avatar" src="../assets/images/users/1.jpg" alt="user">
            <span class="hire-candidate-status"></span>
        </div>
            <div class="card-body">
                <h4 class="font-weight-bold mb-0"><a href="<?= base_url('members'); ?>">Member Name / Company</a></h4>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <div class="mt-2">
                    <span class="label label-info">Commercial</span>
                </div>
                <h6 class="d-block mt-2 font-weight-bold">Tag Line Here Lorem ipsum dolor sit amet.</h6>
                <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit.....</h6>
            <hr>
            <div class="d-flex justify-content-between">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target=".modal-invite-to-job">Invite</button>
                    <!-- Rating Average -->
                    <div>
                        <?php $this->load->view('frontend/partials/rating_stars_short') ?>
                        <small>
                            <span class="text-muted m-l-5">( <a href="#"  class="text-muted">15 Reviews</a> )</span>
                        </small>
                    </div>
                <!-- End Rating Average -->
            </div>
        </div>
    </div>
</div>

<!-- Member Row -->
