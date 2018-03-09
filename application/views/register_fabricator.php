<div class="p-0 m-0 mw-100">
    <div class="card">
        <div class="container">
            <div class="row">

            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card card-body">
                <h3 class="box-title m-b-0">Your New Account Details</h3>
                <p class="text-muted m-b-30 font-13"></p>
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <?= form_open('register/fabricator', array('id'=>'form-fab')) ?>
                            <p class="mb-0 mt-5 font-weight-bold">Account Information</p>
                            <hr class="mt-0 mb-5">

                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" placeholder="Enter Username" name="username">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Enter email" name="email">
                            </div>
                            <div class="form-group">
                                <label>Repeat email</label>
                                <input type="email" class="form-control" placeholder="Repeat Email" name="remail">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="pwd">
                            </div>
                            <div class="form-group">
                                <label>Repeat Password</label>
                                <input type="password" class="form-control" placeholder="Repeat Password" name="rpwd">
                            </div>

                            <p class="mb-0 mt-5 font-weight-bold">Contact Information – Will not be shown on e-fab and is required for managing your account</p>
                            <hr class="mt-0 mb-5">

                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control"placeholder="Enter First Name" name="firstname">
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" placeholder="Enter Last Name" name="lastname">
                            </div>
                            <div class="form-group">
                                <label >Birthdate</label>
                                <input type="date" class="form-control" id="date1" name="bday">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control" placeholder="Enter Phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mobile</label>
                                <input type="text" class="form-control" placeholder="Enter Mobile" name="mobile">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control"placeholder="Enter Address" name="address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City/Province</label>
                                <input type="text" class="form-control"  placeholder="Enter City/Province" name="city">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">State</label>
                                <input type="text" class="form-control" placeholder="Enter State" name="state_id">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Country</label>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <select class="form-control" name="country_id">
                                            <option>Austrilia</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <p class="mb-0 mt-5 font-weight-bold">Security Question</p>
                            <hr class="mt-0 mb-5">

                            <div class="form-group mb-0">
                                <label for="exampleInputEmail1">Your Security Question</label>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <select class="form-control" name="sec_question">
                                            <option></option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <label for="exampleInputEmail1">Your Answer</label>
                                <input type="text" class="form-control"  placeholder="Enter Your Answer" name="sec_answer">
                            </div>

                            <p class="mb-0 mt-5 font-weight-bold">Terms and Mailing</p>
                            <hr class="mt-0 mb-5">

                            <div class="form-group mb-0">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">I accept the Terms and Conditions </label>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox2" type="checkbox">
                                    <label for="checkbox2">I want to receive personalized offers by your site </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox3" type="checkbox">
                                    <label for="checkbox3">Allow partners to send me personalized offers and related services </label>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" id="btn-register">Submit</button>
                                <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                            </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <h2>Hello Fabricators</h2>
			<p>Register your FREE e-fab account now.</p>
			<p>Please populate the fields to start creating your account. An email will be sent to you from e-fab.com.au with instructions on how to verify and complete your registration. </p>
			<p>This forms part of the e-fab security process and will keep your information safe and secure.</p>
			<div id="frm_option">
				<p style="line-height:1.5">I already have an account <a href="signin.html" class="aorange"><b>Sign In!</b> </a></p>
			</div>


		<h2>Need Help?</h2>
			<div id="frm_option" style="line-height:1.5; margin-top:15px">
				<a href="contactus.html" class="aorange">Email us</a> or learn more about <a href="overview.html" class="aorange">e-fab Services</a>
			</div>
        </div>
    </div>
</div>
