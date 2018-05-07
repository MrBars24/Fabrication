<div class="row page-titles">
    <div class="col-md-5 align-self-center">

    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard">Search</a></li>
            <li class="breadcrumb-item active">Jobs</li>
        </ol>
    </div>
</div>
<section class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="stickyside">
                    <div class="card card-body">
                        <div class="input-group input-group-sm mb-4 mt-4">
                            <input type="text" class="form-control border border-white" id="search" placeholder="Search for jobs">
                            <span class="input-group-append">
                                    <button class="btn btn-warning text-white" id="btnsearch">Search</button>
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="">Category</label>
                             <select class="custom-select col-12 filter-categ" id="category">
                                <option value="any">Any</option>
                                <?php foreach($industries as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['display_name'] ?></option>
                                <?php endforeach; ?>
                             </select>
                        </div>
                        <div class="form-group">
                            <label class="">Budget</label>
                            <?php $this->load->view('widgets/budget-input') ?>
                        </div>
                        <div class="col-sm-4 pt-2">
                                <div class="mt-0">
                                    <label>Status</label>
                                    <br>
                                    <input type="radio" class="radio-col-black with-gap" value="all" id="all" name="status" checked>
                                    <label for="all">All</label>

                                    <input type="radio" class="radio-col-black with-gap" value="open" id="open" name="status">
                                    <label for="open">Open</label>

                                    <input type="radio" class="radio-col-black with-gap" value="close" id="close" name="status">
                                    <label for="close">Close</label>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="row pagination-jobs-container" id="final-result"></div>
                <div class="container loader-container"></div>
            </div>
        </div>
    </div>
</section>
