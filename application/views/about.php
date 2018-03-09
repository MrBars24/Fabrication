<div class="container-fluid">
	<div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-b-0">
                        <!-- <h4 class="card-title">Customtab Tab</h4>
                        <h6 class="card-subtitle">Use default tab with class <code>customtab</code></h6> </div> -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#overview" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Overview</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#about_the_site" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">About e-fab</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#why_e_fab" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Why e-fab</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#about_us" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">About us</span></a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="overview" role="tabpanel">
                            <?php $this->load->view('overview'); ?>
                        </div>
                        <div class="tab-pane  p-20" id="about_the_site" role="tabpanel">
                            <?php $this->load->view('about_the_site'); ?>
                        </div>
                        <div class="tab-pane p-20" id="why_e_fab" role="tabpanel">
                            <?php $this->load->view('why_e_fab'); ?>
                        </div>
                        <div class="tab-pane p-20" id="about_us" role="tabpanel">
                            <?php $this->load->view('about_us'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
