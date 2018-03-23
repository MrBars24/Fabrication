<div class="tab-pane" id="job" role="tabpanel">
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
