<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Site Settings</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Content Menu</a></li>
            <li class="breadcrumb-item active">Site Settings</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        	<div class="card">
        	    <?=form_open('admin/site/settings/update',array(
        	    "id"=>"setting-update",
        	    "class"=>"col-lg-6"))?>
	                <div class="card-body">
			            <div class="form-group">
			                <label>Site Footer Message*</label>
			                <input name="site_name" type="text" class="form-control" value="<?=@$config->site_name?>">
			            </div>
			            <div class="form-group">
                            <label>Site Logo</label><br>
                            <?php if(!empty($config->site_logo)): ?>
                            	<img src="/<?=$config->site_logo?>" alt="EFAB LOGO" width="100" height="100">
	                        <?php endif; ?>
                            <input name="site_logo" type="file" class="form-control" aria-describedby="fileHelp">
                        </div>
			        </div>
			        <div class="card-body">
			    		<button type="submit" class="btn btn-success waves-effect waves-light m-r-20">Submit</button>
			    	</div>
		        <?=form_close()?>
		    </div>
        </div>
    </div>
</div>