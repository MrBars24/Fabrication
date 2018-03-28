<style>

.select2-container{
    width: 100% !important;
}

</style>
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
                                                    <input type="text" class="form-control form-control-settings-account d-none" name="public-title" value="<?= $public_details->title; ?>">
                                                <!-- <small class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro, iste.</small> -->
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <span class="font-weight-bold">Keywords</span>
                                                </div>
                                                <div class="col-8 tags-default form-control-settings-account-hide" id="public-keywords-div">
                                                <?php
                                                    $keys = $public_details->keywords;
                                                    $array = explode(',',$keys);
                                                    foreach ($array as $keywords){
                                                ?>
                                                    <span class="public-keywords badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1"><?= $keywords; ?></span>
                                                <?php
                                                    }
                                                ?>
                                                </div>
                                                <div class="col-8 tags-default form-control-settings-account d-none">
                                                <input value="<?= $keywords ?>" type="text" name="public-keywords" class="form-control-settings-account d-none" id="keywords" data-role="tagsinput" placeholder="add tags" />
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <span class="font-weight-bold">Overview</span>
                                                </div>
                                                <div class="col-8">
                                                    <textarea  class="form-control form-control-settings-account d-none" name="public-overview" ><?= $public_details->overview; ?></textarea>
                                                    <p id="public-overview" class="mb-0 form-control-settings-account-hide" data-value-target="public-overview"><?= $public_details->overview; ?></p>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-4">
                                                    <span class="font-weight-bold">Service Description</span>
                                                </div>
                                                <div class="col-8">
                                                    <textarea class="form-control form-control-settings-account d-none" name="public-service"><?= $public_details->service_description; ?></textarea>
                                                    <p id="public-service" class="mb-0 form-control-settings-account-hide" data-value-target="public-service"><?= $public_details->service_description; ?></p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            <?= form_close(); ?>

                            <!-- Avatar -->
                            <div class="card">
                                <div class="p-4">
                                    <h3 class="card-title font-weight-bold mb-0  float-left">Profile Photo</h3>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <?php echo form_open('settings/account/avatar', array('id' => 'form-upload-avatar')) ?>
                                            <div class="row mb-2">
                                                <div class="col-sm-4">
                                                    <div class="content-with-hover-actions">
                                                        <img src="<?= avatar(); ?>" class="img-fluid avatar-preview" alt="">
                                                        <div class="hover-content">
                                                            <span class="inner">
                                                                <button type="button" class="btn btn-dark select-file"><i class="fa fa-picture-o"></i></button>
                                                                <input type="file" class="d-none" id="input-avatar" name="image">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php echo form_close() ?>
                                    </li>
                                </ul>
                                    <!-- The Modal -->
                                    <div class="modal fade" id="modal-crop-avatar">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Crop Image</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <img src="" class="cropper-image img-fluid">
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success btn-save-avatar">Save</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                            </div>
    


                            <!-- Expertise -->
                            <div class="card">
                                <div class="p-4">
                                    <h3 class="card-title font-weight-bold mb-0 float-left">Skills and Achievements</h3>

                                </div>
                                <p><small class="p-4 error-message text-danger"></small></p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="float-left">
                                            <h4>Skills</h4>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-success form-control-settings-expertise" data-toggle="modal" data-target="#exampleModal">Add Skills</button>
                                            <button class="btn btn-success form-control-settings-expertise" data-toggle="modal" data-target="#editSkills">Edit Skills</button>
                                            <!-- <button class="btn btn-success" data-toggle="edit-public-expertise" data-target=".form-control-settings-expertise" >Edit</button> -->
                                        </div>
                                        <div class="clearfix"></div>
                                        <ul id="skills-container">
                                            <?php foreach($skills as $skill): ?>
                                                <li data-id="<?= $skill->smid ?>">
                                                    <h5 class="font-weight-bold"><?= $skill->title ?></h5>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <div class="text-center py-2">
                                            <button class="btn btn-circle btn-success btn-lg form-control-settings-expertise d-none" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="float-left">
                                            <h4>Achievements</h4>
                                        </div>
                                        <div class="float-right">
                                            <button class="btn btn-success" data-toggle="edit-public-specialization" data-target=".form-control-settings-specialization">Edit</button>

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
                                            <button class="btn btn-circle btn-success btn-lg form-control-settings-specialization d-none" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none; padding-right: 19px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Add Skills</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <?= form_open('settings/account/skills/create', array('id'=>'form-skills-create')); ?>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="skills" class="control-label">Skills:</label>
                        <select id="e6" class="" name="skills">
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="editSkills" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none; padding-right: 19px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Edit Skills</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <ul id="skills-container-edit">
                    <?php foreach($skills as $skill): ?>
                        <li class="d-flex justify-content-between align-items-center mb-3" data-id="<?= $skill->smid ?>">
                            <h5 class="font-weight-bold"><?= $skill->title ?></h5>
                            <button type="button" class="btn btn-danger btn-delete-skill" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-trash"></i>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
