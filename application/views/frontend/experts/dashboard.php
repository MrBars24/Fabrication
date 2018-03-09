<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8">
            <!-- Search -->
            <div class="form-group">
                <div class="input-group input-group-lg mt-4">
                    <input type="text" class="form-control border border-white" placeholder="Search for jobs">
                    <span class="input-group-append">
                        <button class="btn btn-success text-white">Search</button>
                    </span>
                </div>
            </div>
        
            <!-- End of Search -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title font-weight-bold mb-0">Job Feed</h4>
                </div>

                <ul class="list-group list-group-flush">
                    <?php foreach(range(0, 10) as $number): ?>
                        <!-- Job List Item -->
                            <?php $this->load->view('frontend/partials/job_item_2') ?>
                        <!-- End of Job List Item -->
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <!-- Right Column -->

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="http://themedesigner.in/demo/admin-press/assets/images/users/3.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="col-8 pl-0">
                            <small class="text-muted">Welcome back</small>
                            <h3 class="font-weight-bold">John Doe</h3>
                            <div class="progress mt-0">
                                <div class="progress-bar bg-success" style="width: 75%; height:15px;" role="progressbar">75%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bids Left -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center flex-column">
                        <span><span class="icon-2x font-weight-bold">8</span>/10</span>
                        <span class="text-muted">bids remaining</span>
                    </div>
                </div>
            </div>
            <!-- End of Bids Left -->

            <!-- Popular Searches -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Popular Searches</h4>

                    <div>
                        <a href="#"><span class="badge badge-pill badge-secondary text-white">House</span></a>
                        <a href="#"><span class="badge badge-pill badge-secondary text-white">Road</span></a>
                        <a href="#"><span class="badge badge-pill badge-secondary text-white">Building</span></a>
                        <a href="#"><span class="badge badge-pill badge-secondary text-white">Test</span></a>
                    </div>
                </div>
            </div>
            <!-- End of Popular Searches -->

            <!-- Top Fabricators -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Top Fabicators</h4>
                </div>
                <ul class="list-unstyled">
                        <li class="media mb-0">
                            <img class="mr-2" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161b5b4ee78%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161b5b4ee78%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.84375%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                            <div class="media-body">
                            <h5 class="mt-0">List-based media object</h5>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </li>
                        <li class="media mb-0">
                            <img class="mr-2" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161b5b4ee78%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161b5b4ee78%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.84375%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                            <div class="media-body">
                            <h5 class="mt-0">List-based media object</h5>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </li>
                        <li class="media mb-0">
                            <img class="mr-2" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_161b5b4ee78%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_161b5b4ee78%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.84375%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                            <div class="media-body">
                            <h5 class="mt-0">List-based media object</h5>
                                Lorem ipsum dolor sit amet.
                            </div>
                        </li>
                    </ul>
            </div>
            <!-- End of Top Fabricators -->
        </div>


        <!-- End of Right Column -->
    </div>
</div>
