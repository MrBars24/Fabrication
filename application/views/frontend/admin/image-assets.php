<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Image Upload</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Content Menu</a></li>
            <li class="breadcrumb-item active">Image Upload</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <?=$this->session->flashdata("page_msg")?>
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-info btn-image align-self-center mb-2"><i class="fa fa-plus"></i> Upload Image</a>
                <input type="file" class="invisible" name="img-upload" id="upload" accept="image/*">
                
                <div class="">
                    <input type="text" class="form-control form-control-line frm-search" value="">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-assets">
                            <thead>
                                <tr>
                                    <th>Thumbnail</th>
                                    <th>Image Name</th>
                                    <th>Upload Time</th>
                                </tr>
                            </thead>
                            <tbody class="pagination-container">

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

<div id="uploadModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="upload-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <?=form_open('/admin/image/upload/submit',array("id"=>"frm-upload","class"=>"modal-content"))?>
            <div class="modal-header">
                <h4 class="modal-title" id="upload-modal-label">Image Upload</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- .Your image -->
                    <div class="col-md-7">
                        <div class="img-container"><img id="image" src="/assets/images/big/img2.jpg" class="img-responsive" alt="Picture"></div>
                    </div>
                    <!-- /.Your image -->
                    <!-- .Croping image -->
                    <div class="col-md-5">
                        <div class="docs-preview clearfix">
                            <div class="img-preview preview-lg"></div>
                            <div class="img-preview preview-md"></div>
                            <div class="img-preview preview-sm"></div>
                            <div class="img-preview preview-xs"></div>
                        </div>
                        <!-- .pixels of image -->
                        <div class="docs-data">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text px-4">X</span>
                                </div>
                                <input type="text" class="form-control" id="dataX" placeholder="x">
                                <div class="input-group-append">
                                    <span class="input-group-text px-4">px</span>
                                </div>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text px-4">Y</span>
                                </div>
                                <input type="text" class="form-control" id="dataY" placeholder="x">
                                <div class="input-group-append">
                                    <span class="input-group-text px-4">px</span>
                                </div>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text px-4">Width</span>
                                </div>
                                <input type="text" class="form-control" id="dataWidth" placeholder="x">
                                <div class="input-group-append">
                                    <span class="input-group-text px-4">px</span>
                                </div>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text px-4">Height</span>
                                </div>
                                <input type="text" class="form-control" id="dataHeight" placeholder="x">
                                <div class="input-group-append">
                                    <span class="input-group-text px-4">px</span>
                                </div>
                            </div>
                            <!-- /.pixels of image -->
                        </div>

                        <div class="docs-toggles">
                            <div class="btn-group btn-group-justified btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-secondary active">
                                    <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
                                    <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 16 / 9"> 16:9 </span> </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
                                    <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 4 / 3"> 4:3 </span> </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                                    <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 1 / 1"> 1:1 </span> </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
                                    <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 2 / 3"> 2:3 </span> </label>
                                <label class="btn btn-secondary">
                                    <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
                                    <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: NaN"> Free </span> </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info waves-effect">Upload</button>
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>