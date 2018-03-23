<style>
    .custom-preloader{
    width: 0;
    height: 0;
    top: 0px;
    position: static;
    z-index: 99999;
    background: #fdfdfd00;
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Package Settings</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Package Settings</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
	<a href="#" class="btn btn-info mb-4 ml-3 add"><i class="fa fa-plus"></i> New Package</a>
	   <?=form_open('/admin/settings/package-settings/create',array('id'=>'frm-package'))?>
		    <div class="row">
		    		<div class="package-container col-lg-12">
		    			
		    		</div>
		    </div>
    	<?=form_close()?>
</div>