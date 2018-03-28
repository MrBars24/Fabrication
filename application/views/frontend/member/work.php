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
    <div class="">
        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
    </div>
</div>
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-sm-3" >
            <div class="stickyside">
                <h1 class="font-weight-bold">Work</h1>
                <div>
                    <?php if(isset($_SESSION['user'])): ?>
                        <?php if($_SESSION['dashboard'] == 'work'): ?>
                            <span><a class="text-mute" style="padding:10px;" href="<?=  base_url(); ?>hire"><i class="mdi mdi-subdirectory-arrow-right"></i>Hire </a></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="input-group input-group-sm mb-4 mt-4">
                            <input type="text" class="form-control border border-white" id="search" placeholder="Search for jobs">
                            <span class="input-group-append">
                                    <button class="btn btn-warning text-white" id="btnsearch">Search</button>
                            </span>
                        </div>
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
                            <select class="custom-select col-12 filter-budget" id="budget">
                                <option value="any" selected>Any</option>
                                <?php foreach($budget_filters as $i): ?>
                                    <option value="<?= $i['min_budget'] ?>-<?= $i['max_budget'] ?>">between <?=  number_format($i['min_budget']); ?> & <?= number_format($i['max_budget']); ?></option>
                                <?php endforeach; ?>
                            </select>
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
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-sm-offset-3">
            <!-- Jobs Feeds -->
            <!-- <div class="d-flex flex-row-reverse">
                <div class="form-inline mt-2 mt-md-0 mb-2">
                    <label class="mr-2">Search</label>
                    <input class="form-control frm-search" type="text" placeholder="" aria-label="Search">
                </div>
            </div> -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold mb-0">Job Feed</h4>
                </div>
                <ul class="list-group list-group-flush pagination-jobs-container">

                </ul>
            </div>
            <div class="container loader-container"></div>
        </div>
            <!-- End of Jobs Feeds -->
        <div class="col-sm-3 ">
            <div class="stickyside is_stuck top-150">
                <div class="card">
                    <div class="card-body">
                        <a href="<?php echo base_url('settings') ?>" class="float-right" data-toggle="tooltip" title="Edit Profile"><i class="mdi mdi-settings"></i></a>
                        <div class="text-center profile-head">
                            <img src="<?= avatar(); ?>" alt="" class="img-fluid">
                        </div>
                        <div class="text-center mt-3">
                            <h4 class="font-weight-bold mb-0"><?php echo auth()->user_details->firstname . ' ' . auth()->user_details->lastname?></h4>
                            <h5 class="mb-3"><?php echo auth()->user_details->address . auth()->user_details->city . auth()->user_details->state . ',' . auth()->user_details->country_name?></h5>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 75%; height:15px;" role="progressbar">75%</div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <div class="d-flex flex-column text-center mt-3">
                                <span><span class="icon-2x font-weight-bold"><?=$summary->my_bids?></span>/<?=$summary->max_bid?></span>
                                <span class="text-muted">bids<br>remaining</span>
                            </div>

                            <div class="d-flex flex-column text-center mt-3">
                                <span><span class="icon-2x font-weight-bold"><?=$summary->my_posts?></span>/<?=$summary->max_post?></span>
                                <span class="text-muted">post<br>remaining</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- <a href="<?php echo base_url('jobs/my-jobs') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Active Contracts</h6>
                            <span class="badge badge-pill badge-secondary">1</span>
                        </a> -->
                        <a href="<?php echo base_url('jobs/bid-history') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Active Biddings</h6>
                            <span class="badge badge-pill badge-secondary"><?=$active_bids?></span>
                        </a>
                        <a href="<?php echo base_url('jobs/invitations') ?>" class="d-flex flex-row justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0">Job Invites</h6>
                            <span class="badge badge-pill badge-secondary">1</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
