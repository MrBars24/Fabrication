<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Jobs</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Jobs</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between">
                <a href="#" data-toggle="modal" data-target=".create-modal" class="btn btn-info mb-2"><i class="fa fa-plus"></i> New Job</a>
                <div class="form-inline mt-2 mt-md-0 mb-2">
                    <label class="mr-2">Search</label>
                    <input class="form-control frm-search" type="text" placeholder="" aria-label="Search">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Project Start</th>
                                    <th>Project End</th>
                                    <th>Budget</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="job-container">
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" class="m-t-40">
                            <ul class="pagination pagination-bars d-flex justify-content-center">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade create-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <?=form_open('/admin/jobs/create',array('class'=>'modal-content','id'=>'frm-job'))?>
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Job</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Industry</label>
                            <select name="industry" class="form-control" id="show-industry">
                                <?php foreach($industries as $industry): ?>
                                <option value="<?= $industry['id'] ?>">
                                    <?= $industry['display_name'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="desc" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bidding Start</label>
                            <input type="text" name="bstart" class="form-control" placeholder="Bidding Start Date" id="bsdate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bidding End</label>
                            <input type="text" name="bend" class="form-control" placeholder="Bidding End Date" id="bedate">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Project Start</label>
                            <input type="text" name="pstart" class="form-control" placeholder="Project Start Date" id="psdate">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Project End</label>
                            <input type="text" name="pend" class="form-control" placeholder="Project End Date" id="pedate">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Project Minimum Budget</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="min_budget" class="form-control" required="" data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Project Maximum Budget</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="max_budget" class="form-control" required="" data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger waves-effect text-left">Submit</button>
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
            <?=form_close()?>
                <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>