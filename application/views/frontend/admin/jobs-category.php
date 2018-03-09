<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Jobs Category</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Jobs Category</li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <a href="#" data-toggle="modal" data-target=".create-modal" class="btn btn-info mb-2"><i class="fa fa-plus"></i> New Job Category</a>
        	<div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Date Created</th>
                                </tr>
                            </thead>
                            <tbody class="category-container">
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example" class="m-t-40">
                            <ul class="pagination pagination-bars d-flex justify-content-center">
                            </ul>
                        </nav>
                    </div>
                </div>
		    </div>
        </div>
    </div>
</div>

<div class="modal fade create-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <?=form_open('/admin/jobs-category/create',array('class'=>'modal-content','id'=>'frm-category'))?>
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Job</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="desc" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                 <button type="submit" class="btn btn-danger waves-effect text-left">Submit</button>
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
        <?=form_close()?>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>