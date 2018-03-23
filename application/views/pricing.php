<section class="home-contact bg-white py-5">
    <div class="container">
        <div class="text-center mb-3">
            <h2 class="font-weight-bold text-center">Pricing</h2>
        </div>
<div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row pricing-plan">
                            <?php foreach ($pricing as $i): 
                            $default = $i['is_default'];
                            if($default == '1'){
                            ?>
                                <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                    <div class="pricing-box featured-plan">
                                        <div class="pricing-body">
                                            <div class="pricing-header">
                                                <h4 class="price-lable text-white bg-warning">Popular</h4>
                                                <h4 class="text-center"><?= $i['package_name']; ?></h4>
                                                <h2 class="text-center"><span class="price-sign">$</span><?= $i['package_price']; ?></h2>
                                                <p class="uppercase">per month</p>
                                            </div>
                                            <div class="price-table-content">
                                                <div class="price-row"><?= $i['package_desc']; ?></div>
                                                <div class="price-row px-3"><?= $i['package_include']; ?></div>
                                                <div class="price-row">
                                                    <button class="btn btn-lg btn-info waves-effect waves-light m-t-20">Sign up</button>
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
                                                <h4 class="text-center"><?= $i['package_name']; ?></h4>
                                                <h2 class="text-center"><span class="price-sign">$</span><?= $i['package_price']; ?></h2>
                                                <p class="uppercase">per month</p>
                                            </div>
                                            <div class="price-table-content">
                                                <div class="price-row"><?= $i['package_desc']; ?></div>
                                                <div class="price-row px-3"><?= $i['package_include']; ?></div>
                                                <div class="price-row">
                                                    <button class="btn btn-success waves-effect waves-light m-t-20">Sign up</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>