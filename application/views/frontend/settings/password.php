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
                                <div class="p-4">
                                    <h3 class="card-title font-weight-bold mb-0  float-left">Password</h3>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Current Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">New Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Confirm Current Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="card-footer">
                                    <input type="submit" class="btn btn-success" value="Save Settings">
                                    </form>
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
