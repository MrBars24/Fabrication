<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">USER EDIT</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/users">Users</a></li>
            <li class="breadcrumb-item active">User Edit</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        	<div class="card">
                <div class="card-body">
                    <?=form_open('/admin/users/edit/'. $this->uri->segment(4) ,array("id"=>"frm-user-edit","class"=>"form-material m-t-40 row"))?>
                        <div class="form-group col-md-4">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control form-control-line" value="<?=$user->firstname?>"> </div>
                        <div class="form-group col-md-4">
                            <label>Middle Name</label>
                            <input type="text" name="middlename" class="form-control form-control-line" value="<?=$user->middlename?>"> </div>
                        <div class="form-group col-md-4">
                            <label>Last Name</label>
                            <input type="text" name="lastname" class="form-control form-control-line" value="<?=$user->lastname?>"> </div>
                        <div class="form-group col-md-12">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control form-control-line" value=""> </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="pwd" class="form-control form-control-line" value=""> </div>
                        <div class="form-group col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" name="cpwd" class="form-control form-control-line" value=""> </div>
                        <div class="form-group col-md-12">
                            <input type="checkbox" name="is_active" id="basic_checkbox_2" class="filled-in" <?=($user->is_active) ? "checked" : "" ?>>
                            <label for="basic_checkbox_2">Activated</label>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                        </div>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>
</div>