
<?php if($job->status != "awarded"): ?>
    <?php if(!empty($bid)): ?>
        <?php foreach($bid as $b): ?>
        <tr>
            <td>
                <div class="row">
                    <div class="col-1">
                        <img src="<?= print_image($b->avatar) ?>" width="50" class="img-circle m-r-10" alt="logo">
                    </div>
                    <div class="col-9">
                        <a href=""><?= $b->fullname; ?></a>
                        <p>
                            <?= $b->cover_letter ?>
                        </p>
                        <div class="like-comm">
                            <a href="<?= base_url('job/bid/accept') ?>/<?= $b->id ?>/<?= $this->uri->segment(4) ?>" class="link m-r-10"><i class="mdi mdi-checkbox-marked-circle text-success"></i> Accept Bid</a>
                            <!-- <a href="<?= base_url('job/bid/decline') ?>/<?= $b->id ?>" class="text-dark m-r-10 btn-decline-bid"><i class="mdi mdi-close text-danger"></i> Decline</a> -->
                            <!-- <a href="javascript:void(0)" class="text-dark m-r-10" data-toggle="modal" data-target=".modal-message-bidder" ><i class="mdi mdi-email text-primary"></i> Message</a> -->

                        </div>
                    </div>
                </div>
            </td>
            <td align="right"><big><h2><span class="label label-light-megna">$<?= $b->amount ?></span></h2></big></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td>
                <div class="row d-flex justify-content-center align-items-center">
                    <p class="text-center text-darked font-weight-bold">
                        NO BIDS YET.
                    </p>
                </div>
            </td>
        </tr>
    <?php endif; ?>
<?php else: ?>
    <tr>
        <td>
            <div class="row">
                <div class="col-1">
                    <img src="<?= print_image($awardedUser->avatar); ?>" width="50" class="img-circle m-r-10" alt="logo">
                </div>
                <div class="col-9">
                    <a href=""><?= $awardedUser->fullname; ?></a>
                    <p>
                        <?=  $awardedUser->bid['0']->cover_letter ?>
                    </p>
                    <div class="like-comm">
                        <!-- <a href="<?= base_url('job/bid/accept') ?>/<?= $b->id ?>/<?= $this->uri->segment(4) ?>" class="link m-r-10"><i class="mdi mdi-checkbox-marked-circle text-success"></i> Accept Bid</a> -->
                        <!-- <a href="<?= base_url('job/bid/decline') ?>/<?= $b->id ?>" class="text-dark m-r-10 btn-decline-bid"><i class="mdi mdi-close text-danger"></i> Decline</a> -->
                        <!-- <a href="javascript:void(0)" class="text-dark m-r-10" data-toggle="modal" data-target=".modal-message-bidder" ><i class="mdi mdi-email text-primary"></i> Message</a> -->

                    </div>
                </div>
            </div>
        </td>
        <td align="right"><big><h2><span class="label label-light-megna">$<?= $awardedUser->bid['0']->amount ?></span></h2></big></td>
    </tr>
<?php endif; ?>
