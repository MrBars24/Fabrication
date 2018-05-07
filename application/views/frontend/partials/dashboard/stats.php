<?php if(auth()->membership_hash != ""): ?>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-around">
            <div class="d-flex flex-row justify-content-between text-center col-6 border-right">
                <span><span class="icon-2x font-weight-bold ml-2"><?=$summary->my_bids?></span>/<?=$summary->max_bid?></span>
                <span class="text-muted">Bids<br>Remaining</span>
            </div>
            <div class="d-flex flex-row justify-content-between text-center col-6">
                <span><span class="icon-2x font-weight-bold ml-2"><?=$summary->my_posts?></span>/<?=$summary->max_post?></span>
                <span class="text-muted">Post<br>Remaining</span>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-column justify-content-around">
			<div class="d-flex text-center col-12">
				<h3 class="mx-auto">Need to post or bid?</h3>
			</div>
            <div class="d-flex col-12">
                <a href="/settings/subscription" class="btn btn-primary mx-auto">Upgrade Your Account</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>