<div class="container-fluid">
    <h1 class="card-title mb-3 font-weight-bold ">Browse Shop Detailers</h1>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search for Detailers">
                    </div>
                    <div class="form-group">
                        <select name="" class="form-control">
                            <option value="" disabled selected>Select Industry</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="" class="form-control">
                            <option value="" disabled selected>Select Expertise</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="" class="form-control">
                            <option value="" disabled selected>Select Country</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select name="" class="form-control">
                                    <option value="" disabled selected>State</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                             <div class="form-group">
                                <input type="text" class="form-control" placeholder="City">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="" class="form-control">
                            <option value="" disabled selected>Select Min Rating</option>
                        </select>
                    </div>
                    <button class="btn btn-success">Search</button>

                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <?php foreach(range(0, 6) as $i): ?>
                        <li class="list-group-item">
                            <?php $this->load->view('frontend/partials/member_item') ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="card-body">
                    <nav aria-label="Page navigation example" class="mt-3">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Invite to Job Modal -->
    <?php $this->load->view('frontend/partials/invite_to_job_modal') ?>
<!-- End of Invite to Job Modal -->