<!-- Member Card -->
    <div class="card">
        <div class="justify-content-center d-flex px-5 mt-3">
            <img class="card-img-top img-responsive rounded-circle img-thumbnail hire-avatar" src="../assets/images/users/1.jpg" alt="user">
            <span class="hire-candidate-status"></span>
        </div>
            <div class="card-body">
                <div class="text-center">
                  <h4 class="font-weight-bold mb-0"><a href="<?= base_url('members'); ?>">Member Name / Company</a></h4>
                  <h6 class="d-block mt-1">Job Title Here Yeah</h6>
                </div>

                <div class="row mt-3">
                  <div class="col-sm-6">
                    <small class="text-muted">Category</small>
                    <div>
                      <span class="badge badge-secondary">Commercial</span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <small class="text-muted">Expertise</small>
                    <div>
                      <span class="badge badge-default">AutoCAD</span>
                    </div>
                  </div>
                  <div class="col-sm-6"></div>
                </div>
                <div class="mt-3">
                  <div class="d-flex flex-direction-row justify-content-between align-items-center">
                    <h6 class="m-0">Location:</h6>
                    <span class="font-weight-bold">Philippines</span>
                  </div>
                  <div class="d-flex flex-direction-row justify-content-between align-items-center">
                    <h6 class="m-0">Job Completed:</h6>
                    <span class="font-weight-bold">1</span>
                  </div>
                </div>
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
<!-- Member Card -->
