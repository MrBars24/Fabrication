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
                                    <div class="row pricing-plan">
                                        <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                            <div class="pricing-box">
                                                <div class="pricing-body b-l">
                                                    <div class="pricing-header">
                                                        <h4 class="text-center">BASIC</h4>
                                                        <h2 class="text-center"><span class="price-sign">$</span>14.95</h2>
                                                        <p class="uppercase">per month</p>
                                                    </div>
                                                    <div class="price-table-content">
                                                        <div class="price-row">TRY IT OUT</div>
                                                        <div class="price-row px-3">View all Attachments + up to 5 Bids</div>
                                                        <div class="price-row">
                                                            <button type="button" class="btn btn-success waves-effect waves-light m-t-20" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Sign Up</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                            <div class="pricing-box b-l">
                                                <div class="pricing-body">
                                                    <div class="pricing-header">
                                                        <h4 class="text-center">STANDARD</h4>
                                                        <h2 class="text-center"><span class="price-sign">$</span>28.95</h2>
                                                        <p class="uppercase">per month</p>
                                                    </div>
                                                    <div class="price-table-content">
                                                        <div class="price-row">POPULAR</div>
                                                        <div class="price-row px-3">View all Attachments + up to 30 Bids</div>
                                                        <div class="price-row">
                                                            <button type="button" class="btn btn-success waves-effect waves-light m-t-20" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Sign Up</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                            <div class="pricing-box featured-plan">
                                                <div class="pricing-body">
                                                    <div class="pricing-header">
                                                        <h4 class="price-lable text-white bg-warning">Popular</h4>
                                                        <h4 class="text-center">PREMIUM</h4>
                                                        <h2 class="text-center"><span class="price-sign">$</span>44.50</h2>
                                                        <p class="uppercase">per month</p>
                                                    </div>
                                                    <div class="price-table-content">
                                                        <div class="price-row">FREQUENT USE</div>
                                                        <div class="price-row px-3"> View all Attachments + up to 70 Bids</div>
                                                        <div class="price-row">
                                                            <button type="button" class="btn btn-lg btn-info waves-effect waves-light m-t-20" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Sign Up</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                            <div class="pricing-box">
                                                <div class="pricing-body b-r">
                                                    <div class="pricing-header">
                                                        <h4 class="text-center">BULK</h4>
                                                        <h2 class="text-center"><span class="price-sign">$</span>365</h2>
                                                        <p class="uppercase">per year</p>
                                                    </div>
                                                    <div class="price-table-content">
                                                        <div class="price-row">ECONOMICAL</div>
                                                        <div class="price-row px-2">View all Attachments + up to 1000 Bids</div>
                                                        <div class="price-row">
                                                            <button type="button" class="btn btn-success waves-effect waves-light m-t-20" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Sign Up</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                        <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home2" role="tab" aria-selected="false"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Credit Card</span></a> </li>
                        <li class="nav-item"> <a class="nav-link " data-toggle="tab" href="#profile2" role="tab" aria-selected="true"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Paypal</span></a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active show" id="home2" role="tabpanel">
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
                                    <input type="email" id="example-email2" name="example-email" class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-email">Lastname</label>
                                    <input type="email" id="example-email2" name="example-email" class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-email">Expires on</label>
                                    <input type="email" id="example-email2" name="example-email" class="form-control" placeholder="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="example-email">Securty Code/ CVV</label>
                                    <input type="email" id="example-email2" name="example-email" class="form-control" placeholder="">
                                </div>
                                <button type="button" class="btn btn-info ml-3">Continue</button>
                                <button type="button" class="btn btn-info ml-3 pull-right">Close</button>
                            </div>
                        </div>
                        <div class="tab-pane p-20 " id="profile2" role="tabpanel">
                            <div class="row p-20">
                                <div class="col-sm-12">
                                    <div class="col-sm-12 text-center mb-5">
                                        <img src="/assets/paypal-solo.png" class="img-fluid w-50">
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
