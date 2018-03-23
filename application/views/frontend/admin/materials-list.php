<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Materials List</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Materials List</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <a href="#" data-toggle="modal" data-target=".create-modal" class="btn btn-info mb-2 add"><i class="fa fa-plus"></i> New Material</a>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Material Name</th>
                                    <th>Added By</th>
                                    <th>Date Added</th>
                                </tr>
                            </thead>
                            <tbody class="materials-container">
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
        <?=form_open('/admin/settings/materials-list/create',array('class'=>'modal-content','id'=>'frm-materials'))?>
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add New Material</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p id="message" class="text-danger"></p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Material Name</label>
                            <input type="text" name="material_name" class="form-control" focus>
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