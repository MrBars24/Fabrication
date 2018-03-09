
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="custom-container-header mt-0">
                <div class="container">
                    <div class="row">
                        <!--  -->
                        <div class="col-sm-8">
                            <h4 class="card-title font-weight-bold mt-2 text-white">Bid History</h4>

                        </div>

                        <!-- Search Section -->
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group input-group-sm mb-0 ">
                                        <input type="text" class="form-control border border-white" placeholder="Search Bids">
                                        <span class="input-group-append">
                                                <button class="btn btn-warning text-white">Search</button>
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="card">
               

                 <ul class="list-group list-group-flush">
                    <?php foreach(range(0, 10) as $number): ?>
                        <!-- Job List Item -->
                            <?php $this->load->view('frontend/partials/bid_history_item') ?>
                        <!-- End of Job List Item -->
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        
    </div>
</div>