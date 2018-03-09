<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">My Jobs</h3>
        </div>
        <div>
            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-    settings text-white"></i></button>
        </div>
    </div>
    <div class="row el-element-overlay">
        <div class="col-md-12">
            <h4 class="card-title">Active Jobs</h4>
        </div>
        
        <?php foreach(range(0, 7) as $number): ?>
        <!-- Post Job List Item -->
        <?php $this->load->view('frontend/partials/my_jobs_item') ?>
        <!-- End of Job List Item -->
        <?php endforeach; ?>
    </div>
</div>

<!-- Message modal -->
<div class="modal fade modal-job-des" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="">Job Description</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam a vero debitis. Incidunt iste exercitationem ab vitae ad nemo praesentium inventore, distinctio, rerum velit nesciunt!</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, dolor.</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Numquam illo iste incidunt, quis facilis est dolorem quasi officiis laborum, impedit debitis deleniti odio molestias excepturi ipsam culpa consequuntur pariatur voluptatem, ratione iusto! Porro ab distinctio excepturi aspernatur ipsa saepe fuga.</p>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>