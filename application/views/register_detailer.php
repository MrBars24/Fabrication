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
                        <?= form_open('register/detailer', array('id'=> 'form-exp')); ?>
                            <p class="mb-0 mt-5 font-weight-bold">Account Information</p>
                            <hr class="mt-0 mb-5">

                            <div class="form-group">
                                <label >User Name</label>
                                <input type="text" class="form-control"  placeholder="Enter Username" name="username">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control"  placeholder="Enter email" name="email">
                            </div>
                            <div class="form-group">
                                <label>Repeat email</label>
                                <input type="email" class="form-control"  placeholder="Repeat Email" name="remail">
                            </div>
                            <div class="form-group">
                                <label >Password</label>
                                <input type="password" class="form-control"  placeholder="Password" name="pwd">
                            </div>
                            <div class="form-group">
                                <label >Repeat Password</label>
                                <input type="password" class="form-control"  placeholder="Repeat Password" name="rpwd">
                            </div>

                            <p class="mb-0 mt-5 font-weight-bold">Contact Information – Will not be shown on e-fab and is required for managing your account</p>
                            <hr class="mt-0 mb-5">

                            <div class="form-group">
                                <label >First Name</label>
                                <input type="text" class="form-control"  placeholder="Enter First Name" name="firstname">
                            </div>
                            <div class="form-group">
                                <label >Last Name</label>
                                <input type="text" class="form-control"  placeholder="Enter Last Name" name="lastname">
                            </div>
                            <div class="form-group">
                                <label >Birthdate</label>
                                <input type="date" class="form-control" id="date1" name="bday">
                            </div>
                            <div class="form-group">
                                <label >Phone</label>
                                <input type="text" class="form-control"  placeholder="Enter Phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label >Mobile</label>
                                <input type="text" class="form-control"  placeholder="Enter Mobile" name="mobile">
                            </div>
                            <div class="form-group">
                                <label >Address</label>
                                <input type="text" class="form-control"  placeholder="Enter Address" name="address">
                            </div>
                            <div class="form-group">
                                <label >City/Province</label>
                                <input type="text" class="form-control"  placeholder="Enter City/Province" name="city">
                            </div>
                            <div class="form-group">
                                <label >State</label>
                                <input type="text" class="form-control"  placeholder="Enter State" name="state_id">
                            </div>
                            <div class="form-group">
                                <label >Country</label>
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

                            <div class="form-group">
                                <label >Your Security Question</label>
                                <div class="row">
                                    <div class="form-group col-md-4">
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
                            <div class="form-group">
                                <label >Your Answer</label>
                                <input type="text" class="form-control"  placeholder="Enter Your Answer" name="sec_answer">
                            </div>

                            <p class="mb-0 mt-5 font-weight-bold">Work Category</p>
                            <hr class="mt-0 mb-5">

                            <label for="exampleInputEmail1 " class="font-weight-bold">Type</label>
                            <div class="form-group">
                                <h5>Are you an individual provider or business with multiple employees? <span class="text-danger">*</span></h5>
                                <fieldset class="controls">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" value="1" name="work_type" id="styled_radio1" class="custom-control-input" checked> <span class="custom-control-indicator"></span> <span class="custom-control-description">Individual</span> </label>
                                <div class="help-block"></div></fieldset>
                                <fieldset>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" value="2" name="work_type" id="styled_radio2" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Business</span> </label>
                                </fieldset>
                            </div>

                            <label for="exampleInputEmail1 " class="font-weight-bold">Choose a Category:</label>
                            <div class="form-group mb-0">
                                <label >Submit proposals in the following job categories.</label>
                                <div class="checkbox checkbox-success">
                                    <input id="Architectural" type="checkbox" value="Architectural">
                                    <label for="Architectural">Architectural</label>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox checkbox-success">
                                    <input id="Commercial" type="checkbox" value="Commercial">
                                    <label for="Commercial">Commercial</label>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox checkbox-success">
                                    <input id="Industrial" type="checkbox" value="Industrial">
                                    <label for="Industrial">Industrial</label>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox checkbox-success">
                                    <input id="Mining" type="checkbox" value="Mining">
                                    <label for="Mining">Mining</label>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox checkbox-success">
                                    <input id="OilAndGas" type="checkbox" value="OilAndGas">
                                    <label for="OilAndGas">Oil & Gas</label>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox checkbox-success">
                                    <input id="Residential" type="checkbox" value="Residential">
                                    <label for="Residential">Residential</label>
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox checkbox-success">
                                    <input id="Other" type="checkbox" value="Other">
                                    <label for="Other">Other</label>
                                </div>
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
                            <div class="form-group mb-0">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox3" type="checkbox">
                                    <label for="checkbox3">Allow partners to send me personalized offers and related services </label>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                            </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">

			<h2 style="margin-top:20px">Expert Shop Detailer</h2>
			<p style="padding:8px 0px;">Apply now for a FREE e-fab account!</p>

			<p style="padding:8px 0px;">Please fill the fields below to start your application process. An email will be sent to you from e-fab.com.au with instructions to complete via email verification. </p>
			<p style="padding:8px 0px;">This forms part of e-fab security process and will keep all information secure	</p>
			<div style="border-bottom:1px solid #ddd; height:20px; margin-bottom:10px"><b>Need Help?</b></div>
			<div id="frm_option">
				<a href="http://www.e-fab.com.au/contactus.html" target="_blank" class="aorange">Email us</a> or learn more about <a href="http://www.e-fab.com.au/shop-detailers.html#How it works" target="_blank" class="aorange">e-fab Services</a>
			</div>

			<div style="border-bottom:1px solid #ddd; height:20px;"></div>

			<div id="frm_option">
				<p>I already have an account <a href="http://www.e-fab.com.au/signin.html" class="aorange"><b>Sign In!</b> </a></p>
			</div>

        </div>
    </div>
</div>
