<style>
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
    }
</style>
<div class="dashboard-header py-4">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-sm-4">
          <h1 class="font-weight-bold text-white title-with-underline">Hire</h1>
          <h2 class="text-light mb-4">Find Professionals Who Get The Job Done</h2>
          <div>
              <?php if(!isset($_SESSION['user'])): ?>
                  <?php else: ?>
                  <?php if($_SESSION['dashboard'] == 'hire'){ ?>
                      <span><a class="text-light btn btn-info btn-sm" style="padding:10px;" href="<?=  base_url(); ?>work"><i class="mdi mdi-subdirectory-arrow-right"></i>Switch to Work</a></span>
                  <?php }?>
              <?php endif; ?>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="row align-items-end h-100 mt-2">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
              <h3 class="mb-0 text-white">Open Jobs</h3>
              <h2 class="display-3 text-success font-weight-bold">4,500+</h2>
            </div>
            <div class="col-sm-4">
              <h3 class="mb-0 text-white">Fabricators</h3>
              <h2 class="display-3 text-success font-weight-bold">300+</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">

    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Hire</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <div class="stickyside pt-3">
                <?php $this->load->view('frontend/partials/dashboard/stats') ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold mb-0">My Active Job Posts</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php 
							$i = 0;
							foreach($active_jobs as $job): 
								if(++$i==4) break;
							?>
                            <li class="list-group-item">
                              <div class=" d-flex justify-content-between align-items-start">
                                <a href="<?php echo base_url('jobs/'.$job->id) ?>">
                                    <div>
                                        <h5 class="mb-0 text-black font-weight-bold"><?=$job->title?></h5>
                                        <small class="text-muted"><?=date_new_format($job->created_at)?></small>
                                    </div>
                                </a>
                                <div>
                                    <span class="d-block text-right"><a href="<?php echo base_url('jobs/posted/manage/'.$job->id) ?>"><i class="fa fa-edit"></i></a></span>
                                </div>
                              </div>
                              <did class="d-flex flex-row justify-content-between">
                                <div>
                                  <span>Bids: <span class="font-weight-bold"><?=$job->bids?></span></span>
                                  <!-- <span class="badge badge-pill badge-warning align-middle">1 New</span> -->
                                </div>
                                <div>
                                  <span>Discussion: <span class="font-weight-bold"><?=$job->discussion_count?></span></span>
                                  <!-- <span class="badge badge-pill badge-warning align-middle">1 New</span> -->
                                </div>

                              </did>
                            </li>
                        <?php endforeach; ?>
						<li class="list-group-item">
                            <div class=" d-flex justify-content-between align-items-start text-center">
                                <a class="mx-auto" href="<?php echo base_url('jobs/posted/active') ?>">
                                    View All Active Jobs
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url('jobs/bid-history') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Saved Experts</h6>
                            <span class="badge badge-pill badge-secondary">1</span>
                        </a>
                        <a href="<?php echo base_url('jobs/invitations') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Job Invites</h6>
                            <span class="badge badge-pill badge-secondary">1</span>
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="col-sm-8">
            <!-- Experts -->
                <div class="card mt-3">
                    <div class="card-body">
                        <div id="accordionexample" class="accordion" role="tablist" aria-multiselectable="true">
                          <form id="form-hire-filter">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="input-group search-form">
                                        <input type="text" name="search_text" class="form-control border" placeholder="Search for Experts">
                                        <span class="input-group-append">
                                          <button class="btn btn-success"
                                            aria-expanded="true"
                                            aria-controls="collapseHire"
                                            data-toggle="collapse"
                                            href="#collapse-filter-hire"
                                            title="More Filter Options">
                                              <i class="fa fa-sliders"></i>
                                          </button>
                                          <button type="button" class="btn-text-search btn btn-success input-group-addon text-white">
                                            <i class="fa fa-search"></i>
                                          </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-5 text-right">
                                    <a href="<?php echo base_url('/jobs/create') ?>" class="btn btn-success"><i class="fa fa-plus mr-1"></i> Post Job</a>
                                </div>
                            </div>

                              <div id="collapse-filter-hire" class="collapse mt-3" role="tabpanel" aria-labelledby="headingOne">
                                <div class="form-group">
                                  <label class="">Category</label>
                                  <select class="form-control" name="category">
                                     <option value="any">Any</option>
                                     <?php foreach($industries as $i): ?>
                                         <option value="<?= $i['id'] ?>"><?= $i['display_name'] ?></option>
                                     <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label class="">Country</label>
                                  <select name="country" class="form-control input-sm" name="country">
                                      <option value="any">Any</option>
                                      <?php foreach($countries as $country): ?>
                                          <option value="<?= $country->id ?>"><?= $country->printable_name ?></option>
                                      <?php endforeach; ?>
                                  </select>
                                </div>
                                <!--<div class="form-group">
                                  <label class="">Rating</label>
                                  <select name="rating" class="form-control input-sm">
                                      <option value="any">Any</option>
                                      <?php /*foreach(range(1,4) as $i): */?>
                                        <option value="<?php /*echo $i */?>">Above <?php /*echo $i */?></option>
                                      <?php /*endforeach; */?>
                                  </select>
                                </div>-->
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="comment-widgets mb-0">

                    <div class="d-flex row pagination-members-container"></div>
                    <div class="container loader-container"></div>

                </div>
            <!-- End of Experts -->
        </div>
    </div>
</div>



<!-- Invite to Job Modal -->
<?php $this->load->view('frontend/partials/invite_to_job_modal') ?>
<!-- End of Invite to Job Modal -->
