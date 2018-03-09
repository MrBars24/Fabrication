<!-- Member Row -->
<div class="d-flex flex-row comment-row">
    <div class="p-2"><span class="round"><img src="../assets/images/users/1.jpg" alt="user" width="50"></span></div>
    <div class="comment-text w-100 py-0">
        <div class="d-flex justify-content-between">
            <h4 class="font-weight-bold mb-0"><a href="<?= base_url('members'); ?>">Member Name / Company</a></h4>
            <span>
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target=".modal-invite-to-job">Invite</button>
            </span>
        </div>

        <!-- Rating Average -->
            <?php $this->load->view('frontend/partials/rating_stars_short') ?>
            <small>
                <span class="text-muted m-l-5">( <a href="#"  class="text-muted">15 Reviews</a> )</span>
            </small>
        <!-- End Rating Average -->

        <div class="mt-2">
            <span class="label label-info">Commercial</span>
        </div>
        <h6 class="d-block mt-2 font-weight-bold">Tag Line Here Lorem ipsum dolor sit amet.</h6>
        <h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias sed tempore quasi natus vel beatae commodi sint. Expedita iure ipsum optio nemo veniam sed.</h6>
    </div>
</div>
<!-- Member Row -->
