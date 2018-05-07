<div class="tab-pane" id="portfolio" role="tabpanel">
    <div class="card-body">
       <div class="p-4">
           <h3 class="card-title font-weight-bold mb-0 float-left">Portfolio</h3>
        </div>
        <div class="row el-element-overlay mt-5 text-center" id="portfolio-container">
            <?php if($getPortfolios): ?>
                <?php foreach($getPortfolios as $portpolios): ?>
                    <div class="col-sm-4" id="portfolio-id">
                        <div class="el-card-item">
                            <div class="el-card-avatar el-overlay-1 mb-1">
                                <img src="<?= $portpolios->attachments[0]->path ?>" alt="user" class="img-fluid rounded">
                                <!-- <div class="el-overlay scrl-dwn">
                                    <ul class="el-info">
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit view">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div> -->
                            </div>
                            <div class="el-card-content text-center">
                                <h4 class="box-title" id="portfolio-title"><?= $portpolios->project_name ?></h4>
                                <p><?= $portpolios->description ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <h3 class="text-dark font-weight-bold">No portfolio</h3>
                </div>
            <?php endif; ?>
        </div>
     </div>
</div>
