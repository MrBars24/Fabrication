<div class="row page-titles">
    <div class="col-md-5 align-self-center">
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/work">Dashboard</a></li>
            <li class="breadcrumb-item active">Wachlist</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul  class="row pagination-watchlist-container col-12">
            </ul>
        </div>
    </div>
</div>
<div class="modal fade frward-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold" id="exampleModalLabel1">Refer Projects to Friends</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form action="http://efab-prod.tk/work/invite" id="frm-invite" novalidate="" method="post" accept-charset="utf-8">
                        <div class="modal-body">
                            <h3 class="box-title m-b-5"></h3>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="">Option 1: Copy the project URL to your email or IM and send to your friends, family and business</label>
                                    <input class="form-control form-control-sm frm-url" name="url" type="text" data-target-error-text="#error" readonly>
                                    <div class="help-block" hidden>
                                        <ul role="alert">
                                            <li id="error"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
							<div class="col-xs-12">
								<label for="">Option 2: Forward the project using email</label>
							</div>
                            <div class="form-group">
                                <div class="col-xs-12 mt-3">
                                    <label for="">Email Addresses:</label>
                                    <div class="tags-default">
										<input type="email" class="tags form-control" placeholder="email address" required/>
									</div>
                                    <small>Separate addresses with a comma. Maximum 10 email addresses</small>
                                </div>
                            </div>
                                <div class="col-xs-12 mt-3">
                                    <label for="">Personal Message:</label>
                                    <textarea class="form-control" rows="2" type="textarea" required="" name="message"></textarea>
                                    <div class="help-block" hidden>
                                        <ul role="alert">
                                            <li id="error"></li>
                                        </ul>
                                    </div>
                                    <small>1000 characters left</small>
                                </div>
                            <div class="form-group text-center mt-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info  btn-block text-uppercase waves-effect waves-light" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>                </div>
            </div>
        </div>
