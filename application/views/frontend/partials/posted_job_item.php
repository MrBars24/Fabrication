<?php foreach($jobs as $job): ?>
    <div class="sl-item">
        <div class="sl-left">
            <img src="http://themedesigner.in/demo/admin-press/assets/images/users/3.jpg" alt="" class="img-circle">
        </div>
        <div class="sl-right">
            <big><a href="" class="text-primary"><?= $job->title ?></a></big>
            <br>

            <span class="sl-date">
                <?= dateNewFormat($job->created_at) ?>
            </span>

            <p>
                <?= $job->description ?>
            </p>
            <div class="like-comm">
                <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-gavel text-danger"></i> 5 Bids</a>
                <a href="<?= base_url('jobs/posted/manage') ?>/<?= $job->id ?>" class="text-dark m-r-10" data-toggle="tooltip" title="Manage Job"><i class="mdi mdi-settings"></i> Manage</a>
                <a href="/jobs/posted/contract/1" class="text-dark" data-toggle="tooltip" title="View Job"><i class="mdi mdi-eye-outline"></i> View Job</a>
            </div>
        </div>
    </div>
<hr>
<?php endforeach; ?>
