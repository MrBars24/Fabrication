<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="container-header mt-0 border p-2 bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <h4 class="card-title font-weight-bold mt-2 text-dark">PREVIOUS PROJECT</h4>
                        </div>
                        <div class="col-sm-3">

                        </div>
                    </div>
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-9 d-flex align-items-center">
                            <label for="select-sorting" class=" font-weight-bold text-dark px-0">SORT BY:</label>
                            <select id="select-sorting" class="form-control col-4 ml-1">
                                <option value="">Start Date</option>
                                <option value="">Ended Date</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group input-group-sm mb-0">
                                        <input type="checkbox" id="md_checkbox_21" class="filled-in chk-col-blue-grey" checked="">
                                        <label for="md_checkbox_21" class="text-dark">Include ended contracts</label>
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
                    <li class="list-group-item py-4 border-bottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="font-weight-bold">Create Logo Design</h5>
                                    <h6 class=" text-dark font-weight-bold d-flex mt-2"><a href="<?= base_url('members/1') ?>" class="text-dark">Full name </a> <span class="ml-2 text-muted" >Company Name</span></h6>
                                    <h6 class="text-secondary">29 July 2017 - 29 May 2017</h6>
                                    <a href="<?= base_url('jobs/previous-project/1') ?>">View Bid</a>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb2">
                                                <small class="text-secondary mb-0">COMPLETED</small>
                                                <h6 class="text-success font-weight-bold"> 24 DEC 2017</h6>
                                            </div>
                                            <div class="mb2">
                                                <small class="text-secondary mb-0">BUDGET</small>
                                                <h6 class="text-dark font-weight-bold">$ 150,000</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb2">
                                                <small class="text-secondary mb-0">FEEDBACK</small>
                                                <div class="d-flex justify-content-start mb-3">
                                                    <ul class="d-flex flex-row justify-content-center list-style-type-none mb-0">
                                                        <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- End of Job List Item -->
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<section>
    <div class=" mt-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>
