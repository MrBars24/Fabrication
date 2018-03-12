
<?php foreach (array_reverse($portfolios) as $v):?>

<div class="col-sm-4" id="<?= $v['id']; ?>">
    <div class="el-card-item">
        <div class="el-card-avatar el-overlay-1 mb-1">
                <img src="http://themedesigner.in/demo/admin-press/assets/images/big/img3.jpg" alt="user" class="img-fluid rounded">
            <div class="el-overlay scrl-dwn">
                    <ul class="el-info">
                    <li>
                            <button class="btn border-white btn-outline image-popup-vertical-fit" id="portfolio-link" data-toggle="modal" data-target-id = "<?= $v['id'] ?>" data-target=".modal-view-portfolio">
                                <i class="fa fa-eye"></i>
                            </button>
                        <li>
                            <button class="btn border-white btn-outline image-popup-vertical-fit" id="portfolio-edit" data-toggle="modal" data-target-id = "<?= $v['id'] ?>" data-target=".modal-edit-portfolio">
                                <i class="icon-pencil"></i>
                            </button>
                        </li>
                        <li>
                            <button class="btn border-white btn-outline image-popup-vertical-fit" id="portfolio-delete" data-toggle="modal" data-target-id = "<?= $v['id'] ?>" data-target=".modal-delete-portfolio">
                                <i class="icon-trash"></i>
                            </button>
                        </li>
                    </ul>
                </div>
        </div>
        <div class="el-card-content text-left">
            <h5 class="box-title" id="portfolio-title"><?= $v['project_name'];?></h5>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php $this->load->view('frontend/partials/edit_portfolio_modal') ?>
<?php $this->load->view('frontend/partials/delete_portfolio_modal') ?>
