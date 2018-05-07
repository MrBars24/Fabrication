<div class="row page-titles">
    <div class="col-md-5 align-self-center">
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/work">Dashboard</a></li>
            <li class="breadcrumb-item active">Previous Projects</li>
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
            <h1>Previous Projects</h1>
        </div>
        <div class="card-body">
          <div id="jobs-previous">
          </div>
          <div class="pagination" id="jobs-previous-pagination">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
