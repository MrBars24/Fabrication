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
                            <div class="card">
                                <div class="p-4">
                                    <h3 class="card-title font-weight-bold mb-0  float-left">Public Profile</h3>
                                    <span class="float-right">
                                        <button class="btn btn-success">Edit</button>
                                    </span>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Title</span>
                                            </div>
                                            <div class="col-8">
                                                <h5 class="mb-0">Professional Graphics Design</h5>
                                                <small class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro, iste.</small>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Keywords</span>
                                            </div>
                                            <div class="col-8">
                                                <div>
                                                    <span class="badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1">Keyword 1</span>
                                                    <span class="badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1">Keyword 2</span>
                                                    <span class="badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1">Keyword 3</span>
                                                    <span class="badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1">Keyword 4</span>
                                                    <span class="badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1">Keyword 5</span>
                                                    <span class="badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1">Keyword 6</span>
                                                </div>
                                                <small class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro, iste.</small>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Overview</span>
                                            </div>
                                            <div class="col-8">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto beatae fugiat quasi, doloremque minima accusamus.
                                                <small class="text-muted d-block">Crete your overwiew of Business or Summary of your business</small>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Service Description</span>
                                            </div>
                                            <div class="col-8">
                                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Optio vero tempore amet ducimus adipisci repudiandae.</p>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam atque dolore laudantium modi molestias, ab doloribus ipsum maiores nam mollitia dolores tempore pariatur dolorum voluptatem.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

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
