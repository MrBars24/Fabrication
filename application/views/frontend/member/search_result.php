<div class="container-fluid">
    <div class="row">
        
        <!-- Filter -->
        <div class="col-sm-3">
            
            <div class="card">
                <div class="card-header">
                     <h3 class="text-dark"> <big><i class="mdi mdi-search-web" ></i></big> Filter Search</h3> 
                </div>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="#"> 
                                <small>Jobs </small> <span class="badge badge-danger pull-right">19</span>
                            </a>
                        </li> 
                        <li class="list-group-item">
                            <a href="#"> 
                                <small>Fubrication </small> <span class="badge badge-danger pull-right">5</span>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#"> 
                                <small>Experts</small> <span class="badge badge-danger pull-right">33</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="card-header">
                     <h3 class="text-dark"> <big><i class="mdi mdi-search-web" ></i></big> Filter Budget</h3> 
                </div>
                <div class="card">
                    <ul class="list-group list-group-flush text-dark">
                        <li class="list-group-item">
                            <input type="radio" id="opt1" class="radio-col-black with-gap" checked name="budget" value="5000">
                            <label for="opt1">$5,000</label>
                        </li> 
                        <li class="list-group-item">
                            <input type="radio" id="opt2" class="radio-col-black with-gap" name="budget" value="10000">
                            <label for="opt2">$10,000</label>
                        </li>
                        <li class="list-group-item">
                            <input type="radio" id="opt3" class="radio-col-black with-gap" name="budget" value="15000">
                            <label for="opt3">$15,000</label>
                        </li>
                        <li class="list-group-item">
                            <input type="radio" id="opt4" class="radio-col-black with-gap" name="budget" value="20000">
                            <label for="opt4">Up to $20,000</label>
                        </li>

                    </ul>
                </div>
            </div>
            
            
            
        </div>
        <!-- Search result -->
        <div class="col-sm-9">
            
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h3><i class="mdi mdi-worker"></i> Jobs</h3>
                    </div>
                    <div class="card-body">
                        <section>
                            <ul class="list-group list-group-flush list-group-parent">
                                <?php foreach(range(0, 2) as $i): ?>
                                    <li class="mt-3">
                                        <?php $this->load->view('frontend/partials/job_item') ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </section>
                    
                    </div>
                    <div class="card-footer">
                        <div class="row">

                            <!--  -->
                            <div class="col-sm-12 text-center">
                                <div>
                                    <a href="" class="text-dark">SEE ALL</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        
        </div>
    </div>
</div>



