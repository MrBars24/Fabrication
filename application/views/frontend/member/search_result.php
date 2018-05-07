<div class="row page-titles">
    <div class="col-md-5 align-self-center">

    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard">Search</a></li>
            <li class="breadcrumb-item active">Members</li>
        </ol>
    </div>
</div>
<div class="container-fluid">

  <div class="row">
    <div class="col-sm-4 order-2">
      <!-- Categories -->
      <div class="card">
        <div class="card-body">
          <h3>Categories</h3>
          <ul>
            <?php foreach($industries as $industry): ?>
              <li><a href="#"><?php echo $industry['display_name'] ?></a></li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
      <!-- End of Categories -->
      <!-- Categories -->
      <div class="card">
        <div class="card-body">
          <h3>Featured Experts</h3>
          <ul>
            <li><a href="#">John Doe</a></li>
            <li><a href="#">Juan Dela Cruz</a></li>
            <li><a href="#">Stephen Awesome</a></li>
            <li><a href="#">Meister John</a></li>
            <li><a href="#">Axl Rose</a></li>
          </ul>
        </div>
      </div>
      <!-- End of Categories -->
    </div>
    <div class="col-sm-8 order-1">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <ul class="list-style-type-none list-separated-horizontal">
                <!--<li>
                  <a href="#">All</a>
                </li>
                <li>
                  <a href="#">Experts</a>
                </li>
                <li>
                  <a href="#">Company</a>
                </li>-->
                <li>
                  <span class="text-muted text-count">15 Results</span>
                </li>
              </ul>
            </div>
            <div class="col-sm-6">
              <form id="form-search-all">
                <div class="input-group search-form">
                    <input type="text" name="search_text" class="form-control border" placeholder="Search for Jobs, Fabricator, Experts">
                    <span class="input-group-append">
                      <button type="submit" class="btn-text-search btn btn-success input-group-addon text-white">
                        <i class="fa fa-search"></i>
                      </button>
                    </span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <!-- Jobs -->
          <div>
            <h3 class="pull-left">Jobs</h3>
            <a href="/jobs" class="pull-right jobs-see-all">See All</a>
            <div class="clearfix"></div>

            <div class="search-all-jobs-container"></div>

          </div>
          <!-- End of Jobs -->

          <!-- Members -->
          <div>
            <h3 class="pull-left">Experts</h3>
            <a href="/members" class="pull-right members-see-all">See All</a>
            <div class="clearfix"></div>
          </div>

          <div class="search-all-members-container"></div>

          <!-- End of Members -->
        </div>
      </div>
    </div>
  </div>

</div>
