<script src="https://www.paypalobjects.com/api/checkout.js"></script>
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
                                    <h1>Subscription</h1>
                                    <div class="row pricing-plan m-t-30">
                                        <?php 
                                        $default = $member->account_type;
                                        foreach ($pricing as $i): 
                                        $packageId = $i->id;
                            if($default == $packageId){
                            ?>
                                        <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                            <div class="pricing-box featured-plan">
                                                <div class="pricing-body">
                                                    <div class="pricing-header">
                                                        <h4 class="price-lable text-white bg-warning">Active</h4>
                                                        <h4 class="text-center"><?= $i->package_name; ?></h4>
                                                        <h2 class="text-center"><span class="price-sign">$</span><?= $i->package_price; ?></h2>
                                                        <p class="uppercase">
                                                            <?= ($i->package_name == "Bulk") ? 'per year': 'per month'; ?>
                                                        </p>
                                                    </div>
                                                    <div class="price-table-content">
                                                        <div class="price-row">
                                                            <?= $i->package_desc; ?>
                                                        </div>
                                                        <div class="price-row px-3">
                                                            <?= $i->package_include; ?>
                                                        </div>
                                                        <div class="price-row mb-5">
                                                            <button type="button" class="btn btn-danger btn-end waves-effect waves-light m-t-20">End Subscription</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }else{?>
                                        <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                            <div class="pricing-box">
                                                <div class="pricing-body b-l">
                                                    <div class="pricing-header">
                                                        <h4 class="text-center"><?= $i->package_name; ?></h4>
                                                        <h2 class="text-center"><span class="price-sign">$</span><?= $i->package_price; ?></h2>
                                                        <p class="uppercase">
                                                            <?= ($i->package_name == "BULK") ? 'per year': 'per month'; ?>
                                                        </p>
                                                    </div>
                                                    <div class="price-table-content">
                                                        <div class="price-row">
                                                            <?= $i->package_desc; ?>
                                                        </div>
                                                        <div class="price-row px-3">
                                                            <?= $i->package_include; ?>
                                                        </div>
                                                        <div class="price-row">
                                                            <?php 
                                                    if ($i->package_price > $package->package_price){ ?>
                                                            <button type="button" class="btn btn-success btn-signup waves-effect waves-light m-t-20" data-id="<?=
                                                            base64_encode($this->encryption->encrypt($i->id,array(
                                                                    'cipher' => 'blowfish',
                                                                    'mode' => 'cbc',
                                                                    'key' => session_id(),
                                                                    'hmac_digest' => 'sha256',
                                                                    'hmac_key' => KEYCODE
                                                            ))); ?>">Sign Up</button>
                                                            <?php }else{ ?>
                                                            <div class="my-5"></div>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }endforeach; ?>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none; padding-right: 17px;">
    <input type="hidden" name="xhash" id="xhash">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark font-weight-bold" id="exampleModalLabel1">Choose Billing Method</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body p-0">
                <div class="col-md-12 p-0">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#profile2" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Paypal</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home2" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Credit Card</span></a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane show" id="home2" role="tabpanel">
                            <div class="row p-20">
                                <div class="col-sm-12 text-center">
                                    <img src="/assets/paypal-logo.png" class="img-fluid w-50">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="example-email">Card Number</label>
                                    <input type="email" id="example-email2" name="example-email" class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-email">Firstname</label>
                                    <input type="email" id="example-email3" name="example-email" class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-email">Lastname</label>
                                    <input type="email" id="example-email4" name="example-email" class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-email">Expires on</label>
                                    <input type="email" id="example-email5" name="example-email" class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-email">Securty Code/ CVV</label>
                                    <input type="email" id="example-email6" name="example-email" class="form-control" placeholder="">
                                </div>
                                <button type="button" class="btn btn-info ml-3">Continue</button>
                                <button type="button" class="btn btn-info ml-3 pull-right">Close</button>
                            </div>
                        </div>
                        <div class="tab-pane active p-20 " id="profile2" role="tabpanel">
                            <div class="row p-20">
                                <div class="col-sm-12">
                                    <div class="col-sm-12 text-center mb-5">
                                        <div id="paypal-button"></div>
                                    </div>
                                    <button type="button" class="btn btn-info ml-3">Continue</button>
                                    <button type="button" class="btn btn-info ml-3 pull-right" data-dismiss="modal" aria-label="Close">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-end fade bs-example-modal-sm" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">End Subscription</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">Are you sure do you want to end your current subscription?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-yes btn-danger waves-effect">Yes</button>
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">No</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>