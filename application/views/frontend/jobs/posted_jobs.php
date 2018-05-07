<div class="row page-titles">
    <div class="col-md-5 align-self-center">
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/hire">Dashboard</a></li>
            <li class="breadcrumb-item active">Posted Jobs</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
          <?php $this->load->view('frontend/partials/job_bank_sidebar')?>
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header">
                    <h1 class="float-left">Job Posted</h1>
                    <a href="<?= base_url('jobs/create'); ?>" class="btn btn-success float-right" ><i class="fa fa-plus"></i> Post a Job </a>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="profiletimeline my-posted-job">
                                <!-- Post Job List Item
                                <//?php $this->load->view('frontend/partials/posted_job_item') ?>
                                 End of Job List Item -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="pagination pagination-myjobs-bars">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
