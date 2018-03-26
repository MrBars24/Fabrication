
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-3">
                        <!-- Left Menu -->
                            <?php $this->load->view('frontend/partials/settings_nav') ?>
                        <!-- Test -->
                    </div>
                    <div class=" col-lg-9 bg-light-part">
                        <div class="card-body">
                        <!-- Account -->
                            <?= form_open('settings/account/basic', array('id'=>'form-basic')); ?>
                                <div class="card">
                                        <div class="p-4">
                                            <h3 class="card-title font-weight-bold mb-0 float-left">Basic Information</h3>
                                            <span class="d-flex float-right">
                                                <div class="form-control-settings-account d-none ">
                                                    <button type="submit" class="btn btn-success " name="submit">Save Changes</button>
                                                </div>
                                                <button type="button" class="btn btn-success ml-2" data-toggle="edit-settings-input" data-target=".form-control-settings-account">Edit</button>
                                            </span>
                                        </div>

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <span class="font-weight-bold">Username</span>
                                                    </div>
                                                    <div class="col-8 ">
                                                        <h5 class="text-dark form-control-settings-account-hide" data-value-target="username"><?= $_SESSION['user']->username ?></h5>
                                                        <input type="text" class="form-control form-control-settings-account d-none" name="username" value="<?= $_SESSION['user']->username ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <span class="font-weight-bold">Email</span>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 class="text-dark form-control-settings-account-hide" data-value-target="email"><?= $_SESSION['user']->email ?></h5>
                                                        <input type="text" class="form-control form-control-settings-account d-none" name="email" value="<?= $_SESSION['user']->email ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <span class="font-weight-bold">Name</span>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 class="text-dark form-control-settings-account-hide" data-value-target="fullname"><?= $_SESSION['user']->firstname ?> <?= $_SESSION['user']->lastname ?></h5>
                                                        <div class="d-flex">
                                                                <input type="text" class="form-control mr-1 form-control-settings-account d-none" name="firstname" value="<?= $_SESSION['user']->firstname ?>">
                                                                <input type="text" class="form-control ml-1 form-control-settings-account d-none" name="lastname" value="<?= $_SESSION['user']->lastname ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <span class="font-weight-bold">Phone</span>

                                                    </div>
                                                    <div class="col-8">
                                                        <h5 class="text-dark form-control-settings-account-hide" data-value-target="phone"><?= $user_details->phone ?></h5>
                                                        <input type="text" class="form-control form-control-settings-account d-none" name="phone" value="<?= $user_details->phone ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <span class="font-weight-bold">Mobile</span>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 class="text-dark form-control-settings-account-hide" data-value-target="mobile"><?= $user_details->mobile ?></h5>
                                                        <input type="text" class="form-control form-control-settings-account d-none" name="mobile" value="<?= $user_details->mobile ?>">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-4">
                                                        <span class="font-weight-bold">Birthday</span>
                                                    </div>
                                                    <div class="col-8">
                                                        <h5 class="text-dark form-control-settings-account-hide" data-value-target="bday"><?= $user_details->bday ?></h5>
                                                        <input type="text" class="form-control form-control-settings-account d-none" name="bday" value="<?= $user_details->bday ?>">
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>
                                </div>
                            <?= form_close(); ?>
                        <!-- End Account -->


                        <!-- Location -->
                        <?= form_open('settings/account/location', array('id'=>'form-location')); ?>
                            <div class="card">
                                <div class="p-4">
                                    <h3 class="card-title font-weight-bold mb-0 float-left">Location Info</h3>
                                    <span class="d-flex float-right">
                                        <div class="form-control-settings-location d-none ">

                                            <button type="submit" class="btn btn-success " name="">Save Changes</button>
                                        </div>
                                        <button type="button" class="btn btn-success ml-2" data-toggle="edit-settings-input" data-target=".form-control-settings-location">Edit</button>
                                    </span>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Address</span>
                                            </div>
                                            <div class="col-8">
                                                <h5 class="text-dark form-control-settings-location-hide" data-value-target="address_id"><?= $_SESSION['user']->user_details->address ?></h5>
                                                <textarea name="address_id" rows="4" class="form-control  form-control-settings-location d-none"><?= $_SESSION['user']->user_details->address ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">City</span>
                                            </div>
                                            <div class="col-8">
                                                <h5 class="text-dark form-control-settings-location-hide" data-value-target="city_id"><?= $_SESSION['user']->user_details->city ?></h5>
                                                <input type="text" class="form-control form-control-settings-location d-none" name="city_id" value="<?= $_SESSION['user']->user_details->city ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">State</span>
                                            </div>
                                            <div class="col-8">
                                                <h5 class="text-dark form-control-settings-location-hide" data-value-target="state_id"><?= $_SESSION['user']->user_details->state ?></h5>
                                                <input type="text" class="form-control form-control-settings-location d-none" name="state_id" value="<?= $_SESSION['user']->user_details->state ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Country</span>
                                            </div>
                                            <div class="col-8">
                                                <?php 
                                                    $country_selected = '';
                                                    $index = array_search($_SESSION['user']->user_details->country_id, array_column($countries, 'id'));
                                                    if ($index) {
                                                        $country_selected = $countries[$index]->printable_name;
                                                    }
                                                ?>
                                                <h5 class="text-dark form-control-settings-location-hide" data-value-target="country_id"><?php echo $country_selected ?></h5>
                                                <select type="text" class="form-control form-control-settings-location d-none" name="country_id" >
                                                    <?php foreach($countries as $country): ?>
                                                        <option value="<?php echo $country->id ?>" <?php echo ($_SESSION['user']->user_details->country_id == $country->id) ? 'selected' : '' ?>><?php echo $country->printable_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Timezone</span>
                                            </div>
                                            <div class="col-8">
                                                <h5 class="text-dark form-control-settings-location-hide" data-value-target="address_id" Asia/Singapore(UTC+8:00)</h5>
                                                <input type="text" class="form-control form-control-settings-location d-none" name="timezone_id" value="Asia/Singapore(UTC+8:00)">
                                            </div>
                                        </div> -->
                                    </li>
                                </ul>
                            </div>
                        <?= form_close(); ?>
                        <!-- End of Location -->

                        <!-- Billing Info -->
                        <div class="card">
                            <div class="p-4">
                                <h3 class="card-title font-weight-bold mb-0 float-left">Billing Info</h3>
                                <span class="float-right">
                                    <button class="btn btn-success"  data-toggle="edit-settings-input" data-target=".form-control-settings-billing">Edit</button>
                                </span>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <span class="font-weight-bold">Fullname</span>
                                        </div>
                                        <div class="col-8">
                                            <h5 class="text-dark form-control-settings-billing-hide" data-value-target="state_id"><?= $_SESSION['user']->user_details->state ?></h5>
                                            <input type="text" class="form-control form-control-settings-billing d-none" name="state_id" value="<?= $_SESSION['user']->user_details->state ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <span class="font-weight-bold">Address Line 1</span>
                                        </div>
                                        <div class="col-8">
                                            <h5 class="text-dark form-control-settings-billing-hide" data-value-target="state_id"><?= $_SESSION['user']->user_details->state ?></h5>
                                            <input type="text" class="form-control form-control-settings-billing d-none" name="state_id" value="<?= $_SESSION['user']->user_details->state ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <span class="font-weight-bold">Address Line 2</span>
                                        </div>
                                        <div class="col-8">
                                            <h5 class="text-dark form-control-settings-billing-hide" data-value-target="state_id"><?= $_SESSION['user']->user_details->state ?></h5>
                                            <input type="text" class="form-control form-control-settings-billing d-none" name="state_id" value="<?= $_SESSION['user']->user_details->state ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <span class="font-weight-bold">City</span>
                                        </div>
                                        <div class="col-8">
                                            <h5 class="text-dark form-control-settings-billing-hide" data-value-target="state_id"><?= $_SESSION['user']->user_details->state ?></h5>
                                            <input type="text" class="form-control form-control-settings-billing d-none" name="state_id" value="<?= $_SESSION['user']->user_details->state ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <span class="font-weight-bold">State/Province</span>
                                        </div>
                                        <div class="col-8">
                                            <h5 class="text-dark form-control-settings-billing-hide" data-value-target="state_id"><?= $_SESSION['user']->user_details->state ?></h5>
                                            <input type="text" class="form-control form-control-settings-billing d-none" name="state_id" value="<?= $_SESSION['user']->user_details->state ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                            <div class="col-4">
                                                <span class="font-weight-bold">Country</span>
                                            </div>
                                            <div class="col-8">
                                                <?php 
                                                    $country_selected = '';
                                                    $index = array_search($_SESSION['user']->user_details->country_id, array_column($countries, 'id'));
                                                    if ($index) {
                                                        $country_selected = $countries[$index]->printable_name;
                                                    }
                                                ?>
                                                <h5 class="text-dark form-control-settings-billing-hide" data-value-target="country_id"><?php echo $country_selected ?></h5>
                                                <select type="text" class="form-control form-control-settings-billing d-none" name="country_id" >
                                                    <?php foreach($countries as $country): ?>
                                                        <option value="<?php echo $country->id ?>" <?php echo ($_SESSION['user']->user_details->country_id == $country->id) ? 'selected' : '' ?>><?php echo $country->printable_name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                </li>
                            </ul>
                        </div>
                         <!-- End of Billing Info -->
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
