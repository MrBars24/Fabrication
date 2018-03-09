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
                        <button class="btn btn-success" data-toggle="modal" data-target=".modal-add-training"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="row el-element-overlay" id="training-container">
                                            
                <?php $this->load->view('frontend/partials/training_item') ?>                                        
                </div>
            </div>
            <!-- Training -->
        </div>
    </div>
</div>



<!-- Add Training Modal -->
<div class="modal fade modal-add-training" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Add Training</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <?= form_open_multipart('training/create', array("id"=>"form-training-create")); ?>

                <div class="form-group">
                    <h5 class="font-weight-bold">Training Title</h5>
                    <input type="text" name="title" class="form-control" placeholder="Training Title">
                </div>
                <!--
                <div class="form-group">
                    <h5 class="font-weight-bold">Company</h5>
                    <input type="text" class="form-control">
                </div>
                -->
                <div class="form-group">
                    <h5 class="font-weight-bold">Project Description</h5>
                    <textarea rows="5" name="description" class="form-control"></textarea>
                </div>

                                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="font-weight-bold">Training Start Date</h5>
                        <input type="text" name="date_started" class="form-control date-picker-default" placeholder="mm/dd/yyyy">
                    </div>
                    <div class="col-sm-6">
                        <h5 class="font-weight-bold">Training Completed Date</h5>
                        <input type="text" name="date_finished" class="form-control date-picker-default" placeholder="mm/dd/yyyy">
                    </div>
                </div>
                <!--
                <div class="form-group">
                <h5 class="font-weight-bold">Attach files</h5>
                    <div id="dropzone">
                        <form action="/upload" class="dropzone needsclick dz-clickable" id="demo-upload">

                            <div class="dz-message needsclick text-center">
                            Drop files here or click to upload.
                            </div>

                        </form>
                    </div>
                </div>
            -->

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
<!-- Add Traiinng Modal -->
