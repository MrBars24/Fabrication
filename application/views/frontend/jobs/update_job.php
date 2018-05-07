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
                            <h1 class="text-dark card-title">Update Job Details</h1>
                            <p class="card-subtitle">Quickly post your project and get quotation in just a minute. Newly posted project may take up a few seconds to show in job bank and changes to show up in the search results</p>
                            <h4 class="card-title"></h4>

                                <?= form_open_multipart("jobs/update/$job->id", array("id"=>"form-update-job","class"=>" wizard-circle validation-wizard")); ?>
                                <div id="input-hidden-attach">
                                    <input type="hidden" value="" name="removed_attach" id="input-removed-attachments-test">
                                </div>
                                <!-- Step 1 -->
                                <h6>Job Details</h6>
                                <section class="section-wrapper-custom">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="jobTitle" class="text-dark"> Job Title <span class="danger">*</span> </label>
                                            <input type="text" name="title" class="form-control required" id="jobTitle" value="<?= $job->title ?>"> <div class="help-block"></div>
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <label for="showIndustries" class="text-dark"> Job Industry <span class="danger">*</span> </label>
                                            <div class="controls">
                                                <select name="industry" class="form-control required" id="showIndustries">
                                                    <?php foreach($industries as $industry): ?>
                                                        <?php if($industry['display_name'] == $job->project_category): ?>
                                                            <option value="<?php echo $industry['id'] ?>"><?php echo $job->project_category ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <?php foreach($industries as $industry): ?>
                                                        <?php if($industry['display_name'] != $job->project_category): ?>
                                                            <option value="<?php echo $industry['id'] ?>"><?php echo $industry['display_name'] ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="material" class="text-dark"> Job Material <span class="danger">*</span> </label><br>
                                            <?php foreach($material as $m): ?>
												<?php $token = false; ?>
												<?php foreach($job->materials as $mym): ?>
													<?php if($m->id == $mym->id): ?>
														<input type="checkbox" id="<?= $m->id ?>" value="<?= $m->id ?>" name="material[]" class="chk" checked>
														<?php $m->id; ?>
														<label for="<?= $m->id ?>"><?= $m->material_name; ?></label>
														<?php $token = true; ?>
														<?php break; ?>
													<?php endif; ?>
												<?php endforeach; ?>
													<?php if($token == false): ?>
														<input type="checkbox" id="<?= $m->id ?>" value="<?= $m->id ?>" name="material[]" class="chk">
															<?php $m->id; ?>
														<label for="<?= $m->id ?>"><?= $m->material_name; ?></label>
													<?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="form-group col-md-6" id="exampleModal">
                                            <label for="expertise" class=" text-dark"> Job Expertise <span class="danger">*</span> </label>
                                            <select id="expertise" class="form-control required" name="expertise" multiple="multiple">
												<?php foreach($job->expertise as $expertise): ?>
													<option value="<?= $expertise->id ?>" selected><?= $expertise->title; ?></option>
												<?php endforeach; ?>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="form-group col-md-12 mb-0">
                                            <label for="textarea" class="text-dark" > Job description <span class="danger">*</span> </label>
                                            <p>Describe your Project in detail. The more information will help the target the right bidders</p>
                                            <div class="form-group">
                                                <div class="controls">
                                                    <textarea name="description" id="textarea" class="form-control required" rows="5" required="" placeholder="Describe your Job here..."><?= $job->description ?></textarea>
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
                                                    <div class="col-6">
                                                        <div class="form_group">
                                                            <input  class="form-control required greaterThanMax greaterThanZero" name="budget_min"  type="number" placeholder="Enter Minimum Amount" value="<?= $job->budget_min ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form_group">
                                                            <input  class="form-control required" id="budget_max" name="budget_max"  type="number" placeholder="Enter Maximum Amount" value="<?= $job->budget_max ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="example">
                                                <div class=""></div>
                                                <h5 class="text-dark  mt-3">Bidding End</h5>
                                                <div class="row">
    												<div class="input-group col-12 clockpicker">
    			                                        <input type="text" name="bend" class="form-control input-limit-datepicker" placeholder="Bidding End Date" id="bedate" value="<?= $job->bidding_expire_at ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="example">
                                                <h5 class="text-dark d mt-3">Project Start and End</h5>
                                                <div class="row">
                                                    <div class="input-group col-6 clockpicker">
    													<input type="text" name="pstart" class="form-control input-limit-datepicker" placeholder="Project Start Date" id="psdate" value="<?= $job->project_start ?>">
    												</div>
    												<div class="input-group col-6 clockpicker">
                                                        <input type="text" name="pend" class="form-control input-limit-datepicker" placeholder="Project End Date" id="pedate" value="<?= $job->project_end ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h4 class="text-dark ">Project Location</h4>
                                            <div class="controls">
                                                <select name="country" class="form-control required" data-style="form-control btn-secondary">
													  <?php foreach($countries as $country): ?>
														<?php if($country->id == $job->country): ?>
															<option value="<?= $country->id ?>"><?= $country->printable_name ?></option>
														<?php endif; ?>
                                                    <?php endforeach; ?>
													<?php foreach($countries as $country): ?>
														<?php if($country->id != $job->country): ?>
															<option value="<?= $country->id ?>"><?= $country->printable_name ?></option>
														<?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="text" name="state"  class="form-control required mt-3" placeholder="State" value="<?= $job->state ?>">
                                                <input type="text" name="city" class="form-control required mt-3" placeholder="City" value="<?= $job->city ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h4 class="text-dark">Approx Tonnes</h4>
											<?php if($job->approx_tonnes == 0): ?>
                                                <div class="controls">
                                                    <input type="number" name="tonnes" value="" class="form-control tones" disabled>
                                                </div>
                                                <input name="tonnes" type="checkbox" id="tones" checked>
                                                <label for="tones">I am not sure with my tones ranges</label>
											<?php else: ?>
                                                <div class="controls">
                                                    <input type="number" name="tonnes" value="<?= $job->approx_tonnes; ?>" class="form-control tones">
                                                </div>
                                                <input name="tonnes" type="checkbox" id="tones">
                                                <label for="tones">I am not sure with my tones ranges</label>
											<?php endif; ?>
											</div>
                                    </div>
                                </section>
                                <!-- Step 3 -->
                                <h6>Job Attachments</h6>
                                <section class="section-wrapper-custom">
                                    <div class="row w-100">
										<div class="row">
											<div class="col">
												<?php if(!empty($getAttachment) != 0): ?>
													<?php foreach($getAttachment as $attachment): ?>
                                                        <div class="attachment-container">
			                                                <button data-target-id-attachment="<?= $attachment->id ?>" type="button" class="btn btn-removed-attach btn-danger btn-xs mt-1 ml-5 mb-2">removed</button><span class="font-weight-bold ml-1"><?= $attachment->filename ?></span><br>
                                                        </div>
													<?php endforeach; ?>
                                                <?php else: ?>
                                                    <p>No attachment to remove</p>
												<?php endif; ?>
											</div>
										</div>
                                        <div class="col-md-12 mb-5">
                                            <div id="test" class="dropzone w-100"></div>
                                        </div>
                                    </div>
                                </section>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
