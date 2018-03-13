
<!--

<section id="jobs-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="float-left"><i class="mdi mdi-mouse-variant" style="font-size:80px;"></i></div>
                <div class="float-none" style="margin:20px 0 0 10px;">
                    <h2 style="line-height:90%;">Job Bank Accross the World<br>
                        <span style="font-size:.6em;line-height:90%;">Quick search jobs and send quotation. <a href="#">Read Our FAQ</a></span>
                    </h2>
                </div>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div>
</section>
-->
<section class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
                            <select class="custom-select col-12 filter-budget" id="budget">
                                <option value="any" selected>Any</option>
                                <?php foreach($budget_filters as $i): ?>
                                    <option value="<?= $i['min_budget'] ?>-<?= $i['max_budget'] ?>">between <?=  number_format($i['min_budget']); ?> & <?= number_format($i['max_budget']); ?></option>
                                <?php endforeach; ?>
                            </select>
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
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="row pagination-jobs-container col-12" id="final-result">      
                    </div>

                <div class="pagination pagination-jobs-bars col-12 justify-content-center mb-4"></div>
            
            </div>
        </div>
    </div>
</section>
