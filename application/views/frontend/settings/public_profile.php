<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-sm-3">
                        <!-- Left Menu -->
                        <?php $this->load->view('frontend/partials/settings_nav') ?>

        </div>
        
            <!-- Public Profile -->

                    <div class="col-sm-9  bg-light-part">
                        <div class="card-body">
                            <!-- content here -->
                         <?= form_open('settings/account/public-basic', array('id'=>'form-basic-update', 'data-target-id'=>$public_details->id)); ?>
                            <div class="card">
                                <div class="p-4">
                                    <h3 class="card-title font-weight-bold mb-0  float-left">Public Profile</h3>
                                    <span class="float-right">
                                        <button type="submit"  class="btn btn-success form-control-settings-account d-none" name="submit">Save Changes</button>
                                        <button type="button" class="btn btn-success" data-toggle="edit-public-profile" data-target=".form-control-settings-account">Edit</button>
                                    </span>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Title</span>
                                            </div>
                                            <div class="col-8">
                                                <h5 id="public-title" class="mb-0 form-control-settings-account-hide" data-value-target="public-title"> <?= $public_details->title; ?></h5>
                                                <input type="text" class="form-control form-control-settings-account d-none" placeholder=" <?= $public_details->title; ?>" name="public-title">
                                               <!-- <small class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro, iste.</small> -->
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Keywords</span>
                                            </div>
                                            <div class="col-8 tags-default form-control-settings-account-hide" id="public-keywords">
                                            <?php
                                                $keys = $public_details->keywords;
                                                $array = explode(',',$keys);
                                                foreach ($array as $keywords){ 
                                            ?>
                                                <span class="badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1"><?= $keywords; ?></span>                                          
                                            <?php
                                                }
                                            ?>
                                            </div>
                                            <div class="col-8 tags-default form-control-settings-account d-none">
                                            <input type="text" name="public-keywords" class="form-control-settings-account d-none" id="keywords" data-role="tagsinput" placeholder="add tags" />
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Overview</span>
                                            </div>
                                            <div class="col-8">
                                                <textarea  class="form-control form-control-settings-account d-none" name="public-overview" placeholder="<?= $public_details->overview; ?>"></textarea>
                                                <p id="public-overview" class="mb-0 form-control-settings-account-hide" data-value-target="public-overview"><?= $public_details->overview; ?></p>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Service Description</span>
                                            </div>
                                            <div class="col-8">
                                                <textarea class="form-control form-control-settings-account d-none" name="public-service" placeholder="<?= $public_details->service_description; ?>"> </textarea>
                                                <p id="public-service" class="mb-0 form-control-settings-account-hide" data-value-target="public-service"><?= $public_details->service_description; ?></p>
                                                
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?= form_close(); ?>
                            <!-- Industries -->
                            <div class="card">
                                   <div class="p-4">
                                        <h3 class="card-title font-weight-bold mb-0 float-left">Industries</h3>
                                        <span class="d-flex float-right">
                                            <div class="form-control-settings-account d-none ">
                                            </div>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalEditIndustries" data-whatever="@getbootstrap">Edit</button>
                                        </span>
                                   </div>
                                   <ul class="list-group list-group-flush">
                                       <li class="list-group-item">
                                           <ul class="list-style-type-none">
                                               <li class="mb-3">
                                                   <h5 class="font-weight-bold">Mining</h5>
                                                   <h6 class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores, labore!</h6>

                                               </li>
                                               <li class="mb-3">
                                                   <h5 class="font-weight-bold">Architectural</h5>
                                                   <h6 class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores, labore!</h6>
                                               </li>
                                           </ul>
                                       </li>
                                   </ul>
                               </div>
                               <div class="modal fade" id="exampleModalEditIndustries" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h4 class="modal-title" id="exampleModalLabel1">Edit Industries</h4>
                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                           </div>
                                           <?= form_open('settings/account/industries', array('id'=>'form-industry')); ?>
                                               <div class="modal-body">
                                                   <div class="form-group">
                                                       <label for="recipient-name" class="control-label">Select Industries</label>
                                                       <select  class="form-control" name="industry">
                                                           <option value="1" class="">Oil and Mining</option>
                                                           <option value="2" class="">Architectural</option>
                                                           <option value="3" class="">Industries</option>
                                                       </select>
                                                   </div>
                                               </div>
                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                   <button type="submit" class="btn btn-primary">Add Industry</button>
                                               </div>
                                           <?= form_close(); ?>
                                       </div>
                                   </div>
                               </div>
                               <!-- End of Industries -->
                            <!-- end content here -->


                            <!-- Expertise -->
                            <div class="card">
                                <div class="p-4">
                                    <h3 class="card-title font-weight-bold mb-0 float-left">Expertise and Specialization</h3>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="float-left">
                                            <h4>Expertise</h4>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-sm btn-success">Edit</button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <ul>
                                            <li>
                                                <h5 class="font-weight-bold">Expertise 1</h5>
                                                <h6 class="text-muted">Expertise Description</h6>
                                            </li>
                                            <li>
                                                <h5 class="font-weight-bold">Expertise 1</h5>
                                                <h6 class="text-muted">Expertise Description</h6>
                                            </li>
                                            <li>
                                                <h5 class="font-weight-bold">Expertise 1</h5>
                                                <h6 class="text-muted">Expertise Description</h6>
                                            </li>
                                        </ul>
                                        <div class="text-center py-2">
                                            <button class="btn btn-circle btn-success btn-lg"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-left">
                                            <h4>Specialization</h4>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-sm btn-success">Edit</button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <ul>
                                            <li>
                                                <h5 class="font-weight-bold">Specialization 1</h5>
                                                <h6 class="text-muted">Specialization Description</h6>
                                            </li>
                                            <li>
                                                <h5 class="font-weight-bold">Specialization 1</h5>
                                                <h6 class="text-muted">Specialization Description</h6>
                                            </li>
                                            <li>
                                                <h5 class="font-weight-bold">Specialization 1</h5>
                                                <h6 class="text-muted">Specialization Description</h6>
                                            </li>
                                        </ul>
                                        <div class="text-center py-2">
                                            <button class="btn btn-circle btn-success btn-lg"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- End of Expertise -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
