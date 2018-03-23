
<!-- <div class="custom-container-header mt-0">
    <div class="container">
        <div class="row">
            
            
            <div class="col-sm-8">
                <div class="row ">
                    <div class="col-sm-4">
                         <div class="form-group">
                             <label class="text-white">Category</label>
                             <select class="custom-select col-12 " id="inlineFormCustomSelect">
                                 <option value="" disabled selected>Budget Range</option>
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="">All Category</option>
                                    <option value="">Architectural</option>
                                    <option value="">Commercial</option>
                                    <option value="">Industrial</option>
                                    <option value="">Mining</option>
                                    <option value="">Oil & Gas</option>
                                    <option value="">Residential</option>
                                    <option value="">Others</option>
                             </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="text-white">Budget</label>
                            <select class="custom-select col-12" id="inlineFormCustomSelect">
                                <option value="" disabled selected>Budget Range</option>
                                <option value="">between $5,000 & $10,000</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 text-white pt-2">
                        <div class="mt-0">
                            <label>Status</label>
                            <br>
                            <input type="radio" class="radio-col-black with-gap" id="all" name="status" checked>
                            <label for="all">All</label>

                            <input type="radio" class="radio-col-black with-gap" id="open" name="status">
                            <label for="open">Open</label>

                            <input type="radio" class="radio-col-black with-gap" id="close" name="status">
                            <label for="close">Open</label>
                        </div>
                        
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="text-left">
                            <small class="text-white">Showing: <big><b>30 Bookmarked Projects</b></big> </small>
                        </div>
                    </div>
                </div>
            
            </div>
            
            Search Section
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group input-group-sm mb-4 mt-4">
                            <input type="text" class="form-control border border-white" placeholder="Search for jobs">
                            <span class="input-group-append">
                                    <button class="btn btn-warning text-white">Search</button>
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div> -->

<!-- <section>
    <div class="container">
        <h2>Watchlist</h2>
    </div>   
    <ul class="list-group pagination-watchlist-container list-group-flush list-group-striped">
	
    </ul>
    <div class="custom-container-header mt-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="pagination pagination-jobs-bars"></ul>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="">
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul  class="row pagination-watchlist-container col-12">
                </ul>
            </div>
        </div>
    </div>
</section>
