<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-sm-3">
                        <!-- Left Menu -->
                        <?php $this->load->view('frontend/partials/settings_nav') ?>
                    </div>
                    <div class="col-sm-9  bg-light-part">
                        <div class="card-body">
                            <!-- content here -->
                                <div class="card">
                                   <div class="card-body">
                                       <div class="p-4">
                                           <h3 class="card-title font-weight-bold mb-0 float-left">Portfolio</h3>
                                           <span class="float-right">
                                               <button class="btn btn-success add" data-toggle="modal" data-target=".create-modal"><i class="fa fa-plus"></i></button>
                                           </span>
                                       </div>

                                     <div class="row el-element-overlay mt-5" id="portfolio-container">
                                                
                                                   
                                     </div>

                                   </div>
                               </div>
                            <!-- end content here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Project Modal -->
<div class="modal fade create-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Add Project</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <?= form_open_multipart('/settings/portfolio/create', array("id"=>"form-portfolio-create")); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <h5 class="font-weight-bold">Project Title</h5>
                            <input type="text" id="title-input-error" name="title" class="form-control" placeholder="Project Title">
                            <label id="title-error"></label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="form-group">
                            <h5 class="font-weight-bold">Project Category</h5>
                            <select class="form-control category" name="category">
                            <?php foreach ($industries as $i): ?>
                                <option value="<?= $i['id']; ?>"><?= $i['display_name']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
               
                <div class="form-group">
                    <h5 class="font-weight-bold">Project Description</h5>
                    <textarea rows="5" id="description-input-area" name="description" class="form-control"></textarea>
                     <label id="description-error"></label>
                </div>
                        <h5 class="font-weight-bold">Images</h5>
                        <div id="drop-file" class="dropzone"></div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect text-left">Save Project</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <?= form_close(); ?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div></div>

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
                    <h5 class="font-weight-bold">Portfolio Title</h5>
                    <label class="view-name"></label>
                </div>
                <div class="form-group">
                    <h5 class="font-weight-bold">Description</h5>
                    <label class="view-desc"></label>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-6 col-lg-4">
                        <img src="https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="" class="img-fluid">
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <img src="https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="" class="img-fluid">
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <img src="https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="" class="img-fluid">
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
