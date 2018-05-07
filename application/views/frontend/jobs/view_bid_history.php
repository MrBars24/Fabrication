<div class="row page-titles">
    <div class="col-md-5 align-self-center">
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/work">Dashboard</a></li>
            <li class="breadcrumb-item active">Bid History</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
		<!-- Profile -->
      <div class="col-sm-3">
        <?php $this->load->view('frontend/partials/job_bank_sidebar')?>
      </div>
      <div class="col-sm-9">
            <div class="card">
                <div class="card-header">
                    <h1>Bidding History</h1>
                </div>
                <div class="card-body">
                    <div class="bid-history-container">
                    </div>
                    <div class="pagination bid-history-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>
