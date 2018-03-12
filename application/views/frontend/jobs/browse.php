
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

<div class="custom-container-header mt-0">
    <div class="container">
        <div class="row">

            <!--  -->
            <div class="col-sm-8">
                <div class="row ">
                    <div class="col-sm-4">
                         <div class="form-group">
                             <label class="text-white">Category</label>
                             <select class="custom-select col-12 filter-categ" id="inlineFormCustomSelect ">
                                <?php foreach($industries as $i): ?>
								    <option value="<?= $i['id'] ?>" selected><?= $i['display_name'] ?></option>
                                <?php endforeach; ?>
                             </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="text-white">Budget</label>
                            <select class="custom-select col-12 filter-budget" id="inlineFormCustomSelect">
                                <option value="" disabled selected>Budget Range</option>
                                <option value="5000">between $5,000 & $10,000</option>
                                <option value="10000">between $10,000 & $50,000</option>
                                <option value="50000">between $50,000 & $100,000</option>
                                <option value="100000">between $100,000 & $500,000</option>
                                <option value="500000">between $500,000 & $1,000,000</option>
                                <option value="1000000">between $1,000,000 & $10,000,000</option>
                                <option value="10000000">between $10,000,000 & $100,000,000</option>
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

                    <div class="col-sm-12">
                        <div class="text-left">
                            <small class="text-white">Showing: <big><b>198 Projects</b></big> </small>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Search Section -->
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group input-group-sm mb-4 mt-4">
                            <input type="text" class="form-control border border-white" id="search" placeholder="Search for jobs">
                            <span class="input-group-append">
                                    <button class="btn btn-warning text-white" id="btnsearch">Search</button>
                            </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<section>
    <ul class="list-group list-group-flush list-group-striped pagination-jobs-container" id="final-result">
    </ul>
</section>

<section>
    <div class="custom-container-header mt-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="pagination pagination-jobs-bars">

                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>
