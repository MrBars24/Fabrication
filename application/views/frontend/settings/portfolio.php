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
                                           <h3 class="card-title font-weight-bold mb-0 float-left">Porfolio</h3>
                                           <span class="float-right">
                                               <button class="btn btn-success" data-toggle="modal" data-target=".modal-add-portfolio"><i class="fa fa-plus"></i></button>
                                           </span>
                                       </div>

                                       <div id="project-empty-error"  class="py-5">
                                       <?php if (empty($portfolios)){ ?>
                                           <h2   class="text-center text-muted">You haven't add any project yet.</h2>
                                       <?php 
                                        }else{
                                        } ?>
                                           </div>

                                     <div class="row el-element-overlay" id="portfolio-container">
                                                  
                                           <?php $this->load->view('frontend/partials/portfolio_item') ?>
                                                   
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

<!-- View Project Modal -->
<?php  $this->load->view('frontend/partials/view_portfolio_modal') ?>


<!-- Add Project Modal -->
<div class="modal fade modal-add-portfolio" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Add Project</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <?= form_open_multipart('portfolio/create', array("id"=>"form-portfolio-create")); ?>
                <div class="form-group">
                    <h5 class="font-weight-bold">Project Title</h5>
                    <input type="text" id="title-input-error" name="title" class="form-control" placeholder="Project Title">
                    <label id="title-error"></label>
                </div>
                <div class="form-group">
                    <h5 class="font-weight-bold">Project Category</h5>
                    <select class="form-control" name="category">
                        <option value="">1</option>
                        <option value="">2</option>
                        <option value="">3</option>
                    </select>
                </div>
                <div class="form-group">
                    <h5 class="font-weight-bold">Project Description</h5>
                    <textarea rows="5" id="description-input-area" name="description" class="form-control"></textarea>
                     <label id="description-error"></label>
                </div>
                <div class="form-group">
                    <h5 class="font-weight-bold">Images</h5>
                  
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="font-weight-bold">Date Started</h5>
                        <input type="text" name="date_started" class="form-control date-picker-default" placeholder="mm/dd/yyyy">
                    </div>
                    <div class="col-sm-6">
                        <h5 class="font-weight-bold">Date Finished</h5>
                        <input type="text" name="date_finished" class="form-control date-picker-default" placeholder="mm/dd/yyyy">
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect text-left">Save Project</button>
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cancel</button>
            </div>
            
        </div>
        <?= form_close(); ?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
