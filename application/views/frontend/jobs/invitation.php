<div class="row page-titles">
    <div class="col-md-5 align-self-center">
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/work">Dashboard</a></li>
            <li class="breadcrumb-item active">Job Invitations</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
<!--    Profile    -->
        <div class="col-sm-3">
          <?php $this->load->view('frontend/partials/job_bank_sidebar')?>
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header">
                    <h1>Job Invitation</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="jobs-invitation-container">
                            </div>

                            <div class="pagination jobs-invitation-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


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

<!-- Container body -->

<!--

<div class="container-fluid">
	<div class="row">
-->

		<!-- For Search Invitaion  -->
<!-- 		<div class="col-lg-3">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"></h4>

					<form>

						<a class="btn btn-outline-info btn-block"> Archive </a>



						<button type="submit" class="btn btn-info btn-block">Submit</button>
					</form>
				</div>
			</div>
		</div>

 -->

		<!-- For List -->
<!--
		<div class="col-lg-12">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="#accepted">Invitation</a></li>
				    <li class="breadcrumb-item"><a href="#accepted">Accepted</a></li>
				    <li class="breadcrumb-item"><a href="#declined">Declined</a></li>
				    <li class="breadcrumb-item"><a href="#archived">Archived</a></li>

				</ol>
			</nav>
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-9 text-center text-dark">
							 Header
						 	<label><b> (4) Job Invitation </b></label>
						</div>
						<div class="col-lg-3">
							<div class="form-inline">
								<label for="inputEmail3" class="col-sm-2 text-left control-label col-form-label">Search</label>
								<div class="col-sm-10">
									<div class="form-group">
										<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Job Invitation">
									</div>
								</div>
							</div>
						</div>
					</div>
			 	</div>
			</div>
-->
			<!-- List
			<div class="card">
				<!-- <ul class="list-group list-group-flush">
					<li class="list-group-item">
						Jobs
					</li>
				</ul>
				<ul class="list-group list-group-flush">
					<!-- ITEM LIST

				</ul>
				<nav aria-label="Page navigation example">
					<ul class="pagination">
					    <li class="page-item">
					      <a class="page-link" href="#" aria-label="Previous">
					        <span aria-hidden="true">&laquo;</span>
					        <span class="sr-only">Previous</span>
					      </a>
					    </li>
					    <li class="page-item"><a class="page-link" href="#">1</a></li>
					    <li class="page-item active"><a class="page-link" href="#">2</a></li>
					    <li class="page-item"><a class="page-link" href="#">3</a></li>
					    <li class="page-item">
					      <a class="page-link" href="#" aria-label="Next">
					        <span aria-hidden="true">&raquo;</span>
					        <span class="sr-only">Next</span>
					      </a>
					    </li>
				    </ul>
				</nav>
			</div>


		</div>
	</div>
</div>



<!-- Decline Modal -->
<div id="declineModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Decline Invitation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
               	<form>
               		<div class="form-group">
                    	<label for="message-text" class="control-label">Reason for decline:</label>
                        <textarea class="form-control" id="message-text1"></textarea>
                    </div>
               	</form>
            </div>
        	<div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm waves-effect" data-dismiss="modal">Confirm</button>
                <button type="button" class="btn btn-danger btn-sm waves-effect" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
