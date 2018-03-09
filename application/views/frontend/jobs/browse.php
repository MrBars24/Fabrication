
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
<div class="custom-container-header mt-0 ">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 m-t-10">
                        <div class="row ">
                            <div class="col-sm-4">
                                 <div class="form-group">
                                     <label class="text-white">Category</label>
                                     <select class=" col-12 btn dropdown-toggle text-secondary" id="inlineFormCustomSelect ">
                                        <?php foreach($industries as $i): ?>
                                            <option value="<?= $i['id'] ?>" selected><?= $i['display_name'] ?></option>
                                        <?php endforeach; ?>
                                     </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="text-white">Budget</label>
                                    <select class="btn dropdown-toggle text-secondary" id="inlineFormCustomSelect">
                                        <option value="" disabled selected>Budget Range</option>
                                        <option value="5000">$5,000 - $10,000</option>
                                        <option value="10000">$10,000 - $50,000</option>
                                        <option value="50000">$50,000 - $100,000</option>
                                        <option value="100000">$100,000 - $500,000</option>
                                        <option value="500000">$500,000 - $1,000,000</option>
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
                                    <label for="close">Close</label>
                                </div>

                            </div>

                            
                        </div>

                    </div>
                
                    <!-- Search Section -->
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group input-group-sm mb-4 m-l-50 m-t-40">
                                    <input type="text" class="form-control border border-white" id="search" placeholder="Search for jobs">
                                    <span class="input-group-append">
                                            <button class="btn btn-outline-info text-white border-white" id="btnsearch">Search</button>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                 
            </div>

        </div>
<div class="card">
    <div class="card-body">
        <div class="card-header">
           <i class="mdi mdi-rss"></i>  <b>198 jobs found</b>
        </div>
        <section>
            <ul class="list-group list-group-flush list-group-striped pagination-jobs-container" id="final-result">
            </ul>
        </section>

        <section>
            <div class="custom-container-pagination mt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="pagination pagination-right pagination-jobs-bars">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    
</div>