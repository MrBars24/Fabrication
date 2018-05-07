
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
        <div class="col-12">
            <div class="row" id="validation">
                <div class="col-12">
                    <div class="card wizard-content">
                        <div class="card-body  wizard-content-custom">
                            <h1 class="text-dark card-title">Enter Job Details</h1>
                            <p class="card-subtitle">Quickly post your project and get quotation in just a minute. Newly posted project may take up a few seconds to show in job bank and changes to show up in the search results</p>
                            <h4 class="card-title"></h4>
                            <?php if(auth()): ?>
                                <?php if($summary->my_posts >= $summary->max_post): ?>
                                    <div class="ribbon-wrapper card">
                                        <div class="ribbon ribbon-danger">Upgrade Membership</div>
                                        <p class="ribbon-content  text-center">You've reach the maximum amount of posting a job. </p>
                                        <a href="" class="btn btn-success  btn-xs col-2 mt-2">Upgrade Now</a>
                                    </div>
                                <?php endif; ?>
                            <?php endif;?>
                                <?= form_open_multipart('jobs/create-job', array("id"=>"form-job-create","class"=>" wizard-circle validation-wizard")); ?>

                                <!-- Step 1 -->
                                <h6>Job Details</h6>
                                <section class="section-wrapper-custom">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="jobTitle" class="text-dark"> Job Title <span class="danger">*</span> </label>
                                            <input type="text" name="title" class="form-control required" id="jobTitle"> <div class="help-block"></div>
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label for="showIndustries" class="text-dark"> Job Industry <span class="danger">*</span> </label>
                                            <div class="controls">
                                                <select name="industry" class="form-control required" id="showIndustries">
                                                    <?php foreach($industries as $industry): ?>
                                                        <option value="<?php echo $industry['id'] ?>"><?php echo $industry['display_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="material" class="text-dark"> Job Material</label><br>
                                            <?php foreach($material as $m): ?>
                                                <input type="checkbox" id="<?= $m->id ?>" value="<?= $m->id ?>" name="material[]" class="chk">
                                                <?php $m->id; ?>
                                                <label for="<?= $m->id ?>"><?= $m->material_name; ?></label>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="form-group col-md-6" id="exampleModal">
                                            <label for="expertise" class=" text-dark"> Job Expertise <span class="danger">*</span> </label>
                                            <select id="expertise" class="form-control required" name="expertise" multiple="multiple">

                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="form-group col-md-12 mb-0">
                                            <label for="textarea" class="text-dark" > Job description <span class="danger">*</span> </label>
                                            <p>Describe your Project in detail. The more information will help the target the right bidders</p>
                                            <div class="form-group">
                                                <div class="controls">
                                                    <textarea name="description" id="textarea" class="form-control required" rows="5" required="" placeholder="Describe your Job here..."></textarea>
                                                <div class="help-block"></div></div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Step 2 -->
                                <h6>Job Time Frame and Budget</h6>
                                <section class="section-wrapper-custom">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h4 class="text-dark">What is your estimated budget?</h4>
                                                <div class="row">
                                                    <!-- <div class="form-group col-md-4">
                                                        <select name="budget-currency" class="selectpicker form-control required" data-style="form-control btn-secondary">
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
                                                    </div> -->
                                                    <div class="col-6">
                                                        <div class="form_group">
                                                            <input  class="form-control required greaterThanMax greaterThanZero" name="budget_min"  type="number" placeholder="Enter Minimum Amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form_group">
                                                            <input  class="form-control required" id="budget_max" name="budget_max"  type="number" placeholder="Enter Maximum Amount">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="example">
                                                <div class=""></div>
                                                <h5 class="text-dark  mt-3">Bidding End</h5>
                                                <!-- <input class="input-daterange-datepicker required" type="text" name="bidding" value=""> -->
                                                <div class="row">
                                                    <!-- <div class="input-group col-6 clockpicker">
                                                        <input type="text" name="bstart" class="form-control input-limit-datepicker" placeholder="Bidding Start Date" id="bsdate">
                                                    </div> -->
													<div class="col-12">
                                                        <div class="input-group clockpicker">
															<input type="text" name="bend" class="form-control input-limit-datepicker input-special required" placeholder="Bidding End Date" id="bedate">
														</div>
                                                    </div>


    												<!-- <div class="input-group col-6 clockpicker">
    													<input type="text" name="pstart" class="form-control input-limit-datepicker" placeholder="Project Start Date" id="psdate">
    												</div>
    												<div class="input-group col-6 clockpicker">
                                                        <input type="text" name="pend" class="form-control input-limit-datepicker" placeholder="Project End Date" id="pedate">
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="example">
                                                <h5 class="text-dark d mt-3">Project Start and End</h5>
                                                <!-- <input class="form-control input-daterange-datepicker required" type="text" name="project" value=""> -->
                                                <div class="row">
													<div class="input-group col-6 clockpicker flex-column">
    			                                        <input type="text" name="pstart" class="form-control input-limit-datepicker required w-100" placeholder="Project Start Date" id="psdate">
                                                    </div>
													<div class="input-group col-6 clockpicker flex-column">
    			                                        <input type="text" name="pend" class="form-control input-limit-datepicker required w-100" placeholder="Project End Date" id="pedate">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h4 class="text-dark ">Project Location</h4>
                                            <div class="controls">
                                                <!-- <input type="text" name="country" value="" class="form-control required" placeholder="Country"> -->
                                                <select name="country" class="selectpicker form-control required" data-style="form-control btn-secondary">
                                                    <?php foreach($countries as $country): ?>
                                                        <option  value="<?= $country->printable_name ?>"><?= $country->printable_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="text" name="state" value="" class="form-control required mt-3" placeholder="State">
                                                <input type="text" name="city" value="" class="form-control required mt-3" placeholder="City">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h4 class="text-dark">Approx Tonnes</h4>

                                            <div class="controls">
                                                <input type="number" name="tonnes" value="" class="form-control tones">
                                            </div>
                                            <input name="tonnes" type="checkbox" id="tones">
                                            <label for="tones">I am not sure with my tones ranges</label>
                                        </div>
                                    </div>
                                </section>
                                <!-- Step 3 -->
                                <h6>Job Attachments</h6>
                                <section class="section-wrapper-custom">
                                    <div class="row w-100">
                                        <h4 class="text-center">Attach Files (Optional - attach up to 5 files, no more than 50 MB each)</h4>
                                        <div class="col-md-12 mb-5">
                                            <div id="test" class="dropzone w-100"></div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Step 4 -->
                                <!-- <h6>Remark</h6>
                                <section>
                                    <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                </section> -->
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>





            <!-- <div class="card">
                <div class="card-body">
                    <h1 class="text-dark card-title">Add More Job Details</h1>
                    <p class="card-subtitle">Turpis facilisi vitae. Interdum potenti quam. Morbi porta blandit luctus vestibulum dictumst consequat aliquam eveniet. Vel fusce ac turpis arcu lectus sit nulla dui lacus porttitor dolor. Amet neque qui.</p>

                </div>
            </div> -->
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
