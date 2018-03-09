<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Edit Page</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Content Menu</a></li>
            <li class="breadcrumb-item"><a href="/admin/pages">Pages Content</a></li>
            <li class="breadcrumb-item active">Edit Page</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <?=form_open('/admin/pages/update/'.$this->uri->segment(4),array("id"=>"update-page"))?>
                                <div class="form-group">
                                    <label for="page-input">Page Name</label>
                                    <input name="page_name" type="text" class="form-control" id="page-input" placeholder="Enter Page Name" value="<?=$info->name?>">
                                </div>
                                <div class="form-group">
                                    <label for="url-input">Page URL</label>
                                    <input name="page_url" type="text" class="form-control" id="url-input" placeholder="Enter Page URL" value="<?=$info->page_url?>">
                                </div>
                                <div class="form-group">
                                    <label>Custom CSS</label>
                                    <textarea name="custom_css" class="form-control" rows="5">
                                        <?=$info->custom_css?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Custom JS</label>
                                    <textarea name="custom_js" class="form-control" rows="5">
                                        <?=$info->custom_js?>
                                    </textarea>
                                </div>
                                <textarea name="page_content" id="page_content">
                                <?=$info->content?>
                                </textarea><br>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                            <?=form_close();?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>