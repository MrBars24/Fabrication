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
            <h1 class="font-weight-bold text-white title-with-underline">Work</h1>
            <h2 class="text-light mb-4">Jobs you may be interested in</h2>
            <div>
                <?php if(isset($_SESSION['user'])): ?>
                    <?php if($_SESSION['dashboard'] == 'work'): ?>
                        <span><a class="text-light btn-sm btn btn-info" style="padding:10px;" href="<?=  base_url(); ?>hire"><i class="mdi mdi-subdirectory-arrow-right"></i>Switch to Hire </a></span>
                    <?php endif; ?>
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
            <li class="breadcrumb-item active">Work</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="d-flex justify-content-between flex-column card-body">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-style-type-none list-separated-horizontal">
                                <li>
                                    <a href="/jobs">All</a>
                                </li>
                                <li>
                                    <a href="/watch-list">Watchlist</a>
                                </li>
                                <!-- <li>
                                    <a href="#">Companies</a>
                                </li> -->
                            </ul>
                        </div>
                        <div class="col-6 text-right">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control border" id="search" placeholder="Search for jobs">
                                <span class="input-group-append">
                                  <button class="btn btn-success"
                                    aria-expanded="true"
                                    aria-controls="collapseHire"
                                    data-toggle="collapse"
                                    href="#collaps-filter-work"
                                    title="More Filter Options">
                                      <i class="fa fa-sliders"></i>
                                  </button>
                                  <button class="btn btn-success input-group-addon text-white" id="btnsearch"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div id="collaps-filter-work" class="col-12 collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="form-group">
                            <label class="">Category</label>
                             <select class="custom-select col-12 filter-categ" id="category">
                                <option value="any">Any</option>
                                <?php foreach($industries as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['display_name'] ?></option>
                                <?php endforeach; ?>
                             </select>
                        </div>
                        <div class="form-group">
                            <label class="">Budget</label>
                            <?php $this->load->view('widgets/budget-input') ?>
                        </div>
                        <div class="col-sm-4 pt-2">
                                <div class="mt-0">
                                    <label>Status</label>
                                    <br>
                                    <input type="radio" class="radio-col-black with-gap" value="all" id="all" name="status" checked>
                                    <label for="all">All</label>

                                    <input type="radio" class="radio-col-black with-gap" value="open" id="open" name="status">
                                    <label for="open">Open</label>

                                    <input type="radio" class="radio-col-black with-gap" value="close" id="close" name="status">
                                    <label for="close">Close</label>
									
									<input type="radio" class="radio-col-black with-gap" value="awarded" id="awarded" name="status">
                                    <label for="awarded">Awarded</label>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4" >
            <?php $this->load->view('frontend/partials/dashboard/stats') ?>
            <div class="stickyside">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url('jobs/my-jobs') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Active Jobs Won</h6>
                            <span class="font-weight-bold"><?php echo count($active_won_jobs) ?></span>
                        </a>
                        <a href="<?php echo base_url('jobs/bid-history') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Active Biddings</h6>
                            <span class="font-weight-bold"><?=count($active_bids)?></span>
                        </a>
                        <a href="<?php echo base_url('jobs/invitations') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Job Invites</h6>
                            <span class="font-weight-bold"><?php echo count($active_invites) ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8 col-sm-offset-3">
            <!-- Jobs Feeds -->
            <!-- <div class="d-flex flex-row-reverse">
                <div class="form-inline mt-2 mt-md-0 mb-2">
                    <label class="mr-2">Search</label>
                    <input class="form-control frm-search" type="text" placeholder="" aria-label="Search">
                </div>
            </div> -->
            <div class="d-flex row pagination-jobs-container"></div>
            <div class="container loader-container"></div>
        </div>
    </div>
</div>

<div class="modal fade frward-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold" id="exampleModalLabel1">Refer Projects to Friends</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <?= form_open('work/invite', array('id'=> 'frm-invite','novalidate'=>'')); ?>
                        <div class="modal-body">
                            <h3 class="box-title m-b-5"></h3>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="">Option 1: Copy the project URL to your email or IM and send to your friends, family and business</label>
                                    <input class="form-control form-control-sm frm-url" name="url" type="text" data-target-error-text="#error" readonly>
                                    <div class="help-block" hidden>
                                        <ul role="alert">
                                            <li id="error"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
							<div class="col-xs-12">
								<label for="">Option 2: Forward the project using email</label>
							</div>
                            <div class="form-group">
                                <div class="col-xs-12 mt-3">
                                    <label for="">Email Addresses:</label>
                                    <div class="tags-default">
										<input type="email" class="tags form-control" placeholder="email address" required/>
									</div>
                                    <small>Separate addresses with a comma. Maximum 10 email addresses</small>
                                </div>
                            </div>
                                <div class="col-xs-12 mt-3">
                                    <label for="">Personal Message:</label>
                                    <textarea class="form-control" rows="2" type="textarea" required="" name="message"></textarea>
                                    <div class="help-block" hidden>
                                        <ul role="alert">
                                            <li id="error"></li>
                                        </ul>
                                    </div>
                                    <small>1000 characters left</small>
                                </div>
                            <div class="form-group text-center mt-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info  btn-block text-uppercase waves-effect waves-light" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
