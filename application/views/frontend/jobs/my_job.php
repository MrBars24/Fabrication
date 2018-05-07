<div class="row page-titles">
    <div class="col-md-5 align-self-center">
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/work">Dashboard</a></li>
            <li class="breadcrumb-item active">Active Projects</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
      <?php $this->load->view('frontend/partials/job_bank_sidebar')?>
    </div>
    <div class="col-sm-9">
      <div class="card">
        <div class="card-header">
            <h1>Active Jobs Won</h1>
        </div>
        <div class="card-body">
          <div id="jobs-won-active">

          </div>
          <div class="pagination " id="jobs-won-active-pagination">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
