<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <!-- Left Menu -->
            <?php $this->load->view('frontend/partials/settings_nav') ?>
        </div>
        <div class="col-sm-9">
            <!-- Training -->
            <div class="card">
                <div class="p-4">
                    <div class="float-left">
                        <h3 class="card-title font-weight-bold mb-0">Special Training</h3>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-success" data-toggle="modal" data-target=".create-modal"><i class="fa fa-plus add"></i></button>
                    </div>
                </div>
                <div class="row el-element-overlay m-l-20" id="training-container">                               
                </div>
                
            </div>
            <!-- Training -->
        </div>
    </div>
</div>



<!-- Add Training Modal -->
<div class="modal create-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Add Training</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <?= form_open_multipart('/settings/training/create', array("id"=>"frm-training")); ?>

                <div class="form-group">
                    <h5 class="font-weight-bold">Training Title</h5>
                    <small class="text-danger error-name"></small>
                    <input type="text" name="training_name" class="form-control" placeholder="Training Title">
                </div>
                <div class="form-group">
                    <h5 class="font-weight-bold">Project Description</h5>
                    <small class="text-danger error-desc"></small>
                    <textarea rows="5" name="description" class="form-control"></textarea>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="font-weight-bold">Training Start Date</h5>
                        <small class="text-danger error-start"></small>
                        <input class="form-control" type="date" name="date_start">
                    </div>
                    <div class="col-sm-6">
                        <h5 class="font-weight-bold">Training Completed Date</h5>
                        <small class="text-danger error-end"></small>
                        <input class="form-control" type="date" name="date_end">
                    </div>
                </div>

                        <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect text-left">Save Project</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
        <?= form_close(); ?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- View Traiinng Modal -->
<div class="modal view-modal" id="" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">View Training</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h5 class="font-weight-bold">Training Title</h5>
                    <label class="view-name"></label>
                </div>
                <div class="form-group">
                    <h5 class="font-weight-bold">Project Description</h5>
                    <label class="view-desc"></label>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="font-weight-bold">Training Start Date</h5>
                        <label class="view-start"></label>
                    </div>
                    <div class="col-sm-6">
                        <h5 class="font-weight-bold">Training Completed Date</h5>
                       <label class="view-end"></label>
                    </div>
                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- View Training Modal -->
