<div class="container mt-5">
	<div class="row">
		<div class="col-4 offset-sm-1">
            <div class="card">
                <div class="card-body">
					<?= form_open('login', array('class'=>'form-horizontal', 'id'=>'form-login')); ?>
                        <h3 class="box-title m-b-20">Sign In</h3>
						<div class="row mt-4 alert-login-message">

						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<label for="">Email Address or Username</label>
								<input class="form-control" id="username-focus" type="text" data-target-error-text="#username-error" required="" name="username">
								<div class="help-block" hidden>
									<ul role="alert">
										<li id="username-error"></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<label for="">Password</label>
								<input class="form-control" type="password" data-target-error-text="#password-error" required="" name="pwd">
								<div class="help-block" hidden>
									<ul role="alert">
										<li id="password-error"></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12 font-14">
								<div class="checkbox checkbox-primary pull-left p-t-0">
									<input id="remember-signup" type="checkbox">
									<label > Remember me </label>
								</div> <a href="/forgot-password" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot password?</a> </div>
						</div>
						<div class="form-group text-center m-t-20">
							<div class="col-xs-12">
								<button class="btn btn-info  btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
								<div class="social">
									<a href="#" class="btn btn-facebook btn-facebook-login" data-toggle="tooltip" title="" data-original-title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
									<a href="#" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
									<!-- <div class="g-signin2" data-onsuccess="onSignIn"></div> -->
								</div>
							</div>
						</div>
						<div class="form-group m-b-0">
							<div class="col-sm-12 text-center">
								<div>Don't have an account? <a href="pages-register.html" class="text-info m-l-5"><b>Sign Up</b></a></div>
							</div>
						</div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
		<div class="card col-5 offset-1">
			<?= form_open('register/member',array('class'=>'form-material form-horizontal', 'class'=>'form-exp')) ?>
                <h3 class="font-weight-bold mt-3 font-13"> Your New Account Details </h3>

								<div class="register-message">
								</div>
                <div class="row p-1">
                    <div class="col-6 form-group">
                        <input id="firstname-focus" required type="text" class="form-control" placeholder="Firstname" name="firstname">
                    </div>
                    <div class="col-6 form-group">
                        <input type="text" required class="form-control" placeholder="Lastname" name="lastname">
                    </div>
                    <div class="col-12 form-group">
                        <input type="text" required class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="col-12 form-group">
                        <input type="email" required class="form-control" placeholder="Email Address" name="email">
                    </div>
                    <div class="col-6 form-group">
                        <input type="password" required class="form-control" placeholder="Password" name="pwd">
                    </div>
                    <div class="col-6 form-group">
                        <input type="password" required class="form-control" placeholder="Re-Type Password" name="rpwd">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="checkbox checkbox-success">
                        <input id="chk-terms" type="checkbox" name="terms">
                        <label for="chk-terms">I accept the Terms and Conditions </label>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="checkbox checkbox-success">
                        <input id="chk-offers" type="checkbox">
                        <label for="chk-offers">I want to receive personalized offers by your site</label>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="checkbox checkbox-success">
                        <input id="chk-partners" type="checkbox">
                        <label for="chk-partners">Allow partners to send me personalized offers and related services</label>
                    </div>
                </div>
				<div class="d-flex justify-content-center">
	        		<button class="btn btn-info my-2 waves-effect waves-light" type="submit">Get Started Today</button>
				</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>
