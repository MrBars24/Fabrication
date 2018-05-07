<div class="tab-pane" id="training" role="tabpanel">
    <div class="card-body">
       <div class="p-4">
           <h3 class="card-title font-weight-bold mb-0 float-left">Special Training</h3>
        </div>
        <div class="row el-element-overlay mt-5">
            <div class="row el-element-overlay m-l-20" id="training-container">
                <?php foreach($trainings['data'] as $training): ?>
    				<div id="training-id" class="list-group list-group-flush col-12">
                        <div class="list-group-item pb-4">
                            <h5 class="font-weight-bold mb-1"><?= $training->training_name ?></h5>
                            <h6 class="text-muted"><small><span class="font-weight-bold">From</span> <?= date_new_format($training->date_start); ?></small> <small><span class="font-weight-bold">To</span> <?= date_new_format($training->date_end) ?></small></h6>
                            <h6><?= $training->description ?></h6>
                        </div>
                    </div>
                <?php endforeach; ?>
			</div>
        </div>
     </div>
</div>
