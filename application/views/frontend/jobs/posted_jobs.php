<div class="container">
    <div class="row">

<!--    Profile    -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h1>Job Posted</h1>
                    <a href="<?= base_url('jobs/create'); ?>" class="text-primary " ><i class="mdi mdi-tooltip-edit"></i> Compose new job </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="profiletimeline">
                                <!-- Post Job List Item -->
                                <?php $this->load->view('frontend/partials/posted_job_item') ?>
                                <!-- End of Job List Item -->
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>
</div>



<!--

<div class="">
    <ul class="list-group list-group-flush">

        <li class="list-group-item border-0 py-4">
            <div class="container">
                <div class="row">
                     <div class="col-12 pull-right ">
                                <a href="/job/create" type="button" class="btn btn-xs btn-info m-b-10">Create Job</a>
                            </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-3">
                                <div class="">
                                    <big class="text-secondary mb-0 text-dark">DATE POSTED</big>
                                    <?php foreach (range(0, 10) as $i):?>
                                    <h6  class="text-dark font-weight-bold m-b-20">28 July 2017</h6>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="">
                                    <big class="text-secondary mb-0 text-dark">TITLE</big>
                                    <?php foreach (range(0, 10) as $i):?>
                                    <h6 class="text-dark font-weight-bold m-b-20">This is only for testing job.</h6>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-1 ">
                                <big class="text-secondary mb-0 text-dark">ACTION</big>
                                <?php foreach (range(0, 10) as $i):?>
                                <a href="http://dev.e-fab/jobs/posted-job-view" type="button" class="btn btn-xs btn-info m-b-10">MANAGE</a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>


    </ul>
</div>
-->
