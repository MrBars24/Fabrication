<div class="row page-titles">
   <div class="col-md-5 align-self-center">
      <h3 class="text-themecolor">News and Articles</h3>
   </div>
   <div class="col-md-7 align-self-center">
      <ol class="breadcrumb">
         <li class="breadcrumb-item active">News and Articles</li>
      </ol>
   </div>
</div>
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <a href="#" data-toggle="modal" data-target=".create-modal" class="btn btn-info mb-2 add"><i class="fa fa-plus"></i> New Article</a>
         <div class="card">
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Title</th>
                           <th>Slug</th>
                           <th>Author</th>
                           <th>Date</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody class="news-container">
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
<div class="modal fade view-modal" tabindex="-1" role="dialog" aria-labelledby="asd">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">News and Articles</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-6">
                  <label class="font-weight-bold">Title</label><br>
                  <label class="title"></label>
               </div>
               <div class="col-md-6">
                  <label class="font-weight-bold">Slug</label><br>
                  <label class="slug"></label>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <label class="font-weight-bold">Description</label><br>
                  <label class="desc"></label>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Close</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<div class="modal fade create-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
   <div class="modal-dialog modal-lg">
      <?=form_open('/admin/news/create',array('class'=>'modal-content','id'=>'frm-news'))?>
      <div class="modal-header">
         <h4 class="modal-title" id="myLargeModalLabel">Add News</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control" focus>
                   <small class="text-danger title-error"></small>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label>Slug</label>
                  <input type="text" name="slug" class="form-control">
                   <small class="text-danger slug-error"></small>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <label>Description</label>
                   <small class="text-danger desc-error"></small>
                  <textarea name="desc" id="desc"></textarea>
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