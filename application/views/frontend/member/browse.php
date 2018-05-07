<div class="container-fluid">
    <h1 class="card-title mb-3 font-weight-bold ">Browse Shop Detailers</h1>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body card-search">
                    <div class="input-group input-group-sm mb-4 mt-4">
                        <input type="text" class="form-control" name="text-search" placeholder="Search for Detailers">
                        <span class="input-group-append">
                            <button class="btn btn-warning text-white" id="btnsearch">Search</button>
                        </span>
                    </div>

                    <div class="form-group">
                        <label class="">Category</label>
                        <select class="form-control" name="category">
                            <option value="any">Any</option>
                            <?php foreach($industries as $i): ?>
                                <option value="<?= $i['id'] ?>"><?= $i['display_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="">Country</label>
                        <select name="country" class="form-control input-sm" name="country">
                            <option value="any">Any</option>
                            <?php foreach($countries as $country): ?>
                                <option value="<?= $country->id ?>"><?= $country->printable_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="comment-widgets mb-0">

                <div class="d-flex row pagination-members-container"></div>
                <div class="container loader-container"></div>

            </div>
        </div>
    </div>
</div>

<!-- Invite to Job Modal -->
    <?php $this->load->view('frontend/partials/invite_to_job_modal') ?>
<!-- End of Invite to Job Modal -->