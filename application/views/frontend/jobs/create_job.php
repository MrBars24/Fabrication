
<div class="row page-titles">
    <div class="col-md-5 align-self-center">

    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <?php if(get_referer_endpoint() == "hire"): ?>
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/hire">Hire</a></li>
            <?php endif; ?>
            <li class="breadcrumb-item active">Post Job</li>
        </ol>
    </div>
    <div class="">
        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-8 offset-2">
            <?php if(auth()): ?>
            <?php if($summary->my_posts >= $summary->max_post): ?>
                <div class="ribbon-wrapper card">
                    <div class="ribbon ribbon-danger">Upgrade Membership</div>
                    <p class="ribbon-content  text-center">You've reach the maximum amount of posting a job. </p>
                    <a href="" class="btn btn-success  btn-xs col-2 mt-2">Upgrade Now</a>
                </div>
            <?php endif; ?>
        <?php endif;?>
            <div class="card">
                <div class="card-body">
                    <h1 class="text-dark  card-title"><strong>Post a Job</strong></h1>
                    <p class="card-subtitle">Turpis facilisi vitae. Interdum potenti quam. Morbi porta blandit luctus vestibulum dictumst consequat aliquam eveniet. Vel fusce ac turpis arcu lectus sit nulla dui lacus porttitor dolor. Amet neque qui.</p>
                    <?= form_open_multipart('jobs/create', array("id"=>"form-job-create")); ?>
                        <div class="form-group">
                            <h4 class="text-dark font-weight-bold">Job Title <span class="text-danger">*</span></h4>
                            <div class="controls">
                                <input type="text" name="title" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="text-dark font-weight-bold">Industry<span class="text-danger">*</span></h4>
                            <div class="controls">
                                <select name="industry" class="form-control" id="showIndustries">
                                    <?php foreach($industries as $industry): ?>
                                        <option value="<?php echo $industry['id'] ?>"><?php echo $industry['display_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <h4 class="text-dark font-weight-bold mt-5">Job Description</h4>
                        <p>Vitae eu urna proin vel ante a convallis donec mauris aliquam at. Duis dictum vel justo erat vitae. Et aenean consectetuer. Vel interdum consequat. Leo dolor aenean tortor in ultrices. Magna pede at. Non suspendisse erat magnis vehicula justo. Dis non tincidunt leo interdum proin ut blandit et. Magnis vitae vitae.</p>
                        <div class="form-group">
                            <div class="controls">
                                <textarea name="description" id="textarea" class="form-control" rows="5" required="" placeholder="Describe your Job here..."></textarea>
                            <div class="help-block"></div></div>
                        </div>

                        <div id="test" class="dropzone"></div>
                        <div class="row">
                            <div class="col-6">
                                <h4 class="text-dark font-weight-bold mt-5">Does this project need to be done in a specific location?</h4>
                                <p>Where do you want this done?</p>
                                <div class="controls">
                                    <input type="text" name="location" value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <h4 class="mb-3 text-dark font-weight-bold mt-5">Approx Tonnes</h4>
                                <p></p>
                                <div class="controls">
                                    <input type="number" name="tonnes" value="" class="form-control mt-5">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <div class="">
                                <div class="row">
                                     <div class="col-md-12">
                                         <div class="example">
                                             <h5 class="text-dark font-weight-bold mt-3">Bidding Start and End</h5>
                                             <input class="form-control input-daterange-datepicker" type="text" name="bidding" value="">
                                         </div>
                                    </div>
                                     <div class="col-md-12 mt-3">
                                         <div class="example">
                                             <h5 class="text-dark font-weight-bold mt-3">Project Start and End</h5>
                                             <input class="form-control input-daterange-datepicker" type="text" name="project" value="">
                                         </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <h4 class="text-dark font-weight-bold">What is your estimated budget?</h4>
                                        <div class="row">
                                        <div class="col-md-4">
                                            <select name="budget-currency" class="selectpicker form-control" data-style="form-control btn-secondary">
                                                <option  value="USD">USD</option>
                                                <option  value="NZD">NZD</option>
                                                <option  value="AUD">AUD</option>
                                                <option  value="GBP">GBP</option>
                                                <option  value="HKD">HKD</option>
                                                <option  value="SGD">SGD</option>
                                                <option  value="PHP">PHP</option>
                                                <option  value="EUR">EUR</option>
                                                <option  value="CAD">CAD</option>
                                                <option  value="ZAR">ZAR</option>
                                                <option  value="INR">INR</option>
                                                <option  value="JMD">JMD</option>
                                                <option  value="CLP">CLP</option>
                                                <option  value="MXN">MXN</option>
                                                <option  value="IDR">IDR</option>
                                                <option  value="MYR">MYR</option>
                                                <option  value="SEK">SEK</option>
                                                <option  value="JPY">JPY</option>
                                                <option  value="PLN">PLN</option>
                                                <option  value="BRL">BRL</option>
                                                <option  value="CNY">CNY</option>
                                                <option  value="VND">VND</option>
                                                <option  value="ARS">ARS</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8 ">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form_group">
                                                        <input  class="form-control" name="budget_min"  type="number" placeholder="Enter Minimum Amount">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form_group">
                                                        <input  class="form-control" name="budget_max"  type="number" placeholder="Enter Maximum Amount">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-xs-right mt-5">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-inverse">Cancel</button>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="modal-job-error" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none; padding-right: 19px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Package Upgrade</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h4>You need to upgrade you membership to post another job!</h4>
            </div>
            <div class="modal-footer">
                <a href="/settings/subscription" class="btn btn-success waves-effect">Upgrade Now</a>
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
