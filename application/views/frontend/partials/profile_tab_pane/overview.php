<div class="tab-pane active show" id="overview" role="tabpanel">
    <div class="card-body">
        <h4 class="card-title text-dark font-weight-bold">Overview</h4>
        <p>Vitae eu urna proin vel ante a convallis donec mauris aliquam at. Duis dictum vel justo erat vitae. Et aenean consectetuer. Vel interdum consequat. Leo dolor aenean tortor in ultrices. Magna pede at. Non suspendisse erat magnis vehicula justo. Dis non tin</p>
        <h4 class="card-title text-dark font-weight-bold">Portpolio</h4>
        <p>Vitae eu urna proin vel ante a convallis donec mauris aliquam at. Duis dictum vel justo erat vitae. Et aenean consectetuer. Vel interdum consequat. Leo dolor aenean tortor in ultrices. Magna pede at. Non suspendisse erat magnis vehicula justo. Dis non tin</p>
        <h4 class="card-title text-dark font-weight-bold">Service Description</h4>
        <p>Et aenean consectetuer. Vel interdum consequat. Leo dolor aenean tortor in ultrices. Magna pede at. Non suspendisse erat magnis vehicula justo. Dis non tin</p>
        <hr>
        <h4 class="card-title text-dark font-weight-bold">Reviews</h4>
        <div class="card-body px-0">
            <div class="profiletimeline" id="review-comment">
                <?php foreach($review as $r): ?>
                    <div class="pull-right">
                        <span class="text-warning"></span>
                        <ul class="d-inline-flex flex-row justify-content-start ul-star list-style-type-none mb-0 ml-1">
                            <?php for($i=0; $i<$r->rating; $i++): ?>
                                <li class="mr-1"><a href="#" class="text-warning ratings_stars"><i class="fa fa-star"></i></a></li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> </div>
                        <div class="sl-right">
                            <div><a href="#" class="link">John Doe</a> <span class="sl-date">1 sec ago</span>
                                <p><?= $r->message_review ?></p>
                                <!-- <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div> -->
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        </div>
        <hr>
        <div class="pull-right">
            <span class="text-warning">Ratings</span>
            <ul class="d-inline-flex flex-row justify-content-start ul-star list-style-type-none mb-0 ml-1">
                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
            </ul>
        </div>
        <?= form_open("reviews", array('id'=>'form-reviews','class'=>'form-material')); ?>
            <textarea class="form-control" name="message_review" rows="10" placeholder="Write Review"></textarea>
            <input type="hidden" name="rating" value="">
            <input type="hidden" name="review_id" value="<?= $user->id ?>">
            <div class="">
                <button type="submit" class="pull-right mb-2 btn btn-primary">Submit</button>
            </div>
        <?= form_close(); ?>
    </div>
</div>
