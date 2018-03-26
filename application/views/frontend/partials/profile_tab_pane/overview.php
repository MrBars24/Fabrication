<style>
.stars-outer{
    display: inline-block;
    position: relative;
    font-family: FontAwesome;
    margin-left: 1px;
    letter-spacing: 2px;
}

.stars-inner {
  position: absolute;
  top: 0;
  left: 0;
  white-space: nowrap;
  overflow: hidden;
}

.stars-outer::before {
    content: "\f006 \f006 \f006 \f006 \f006";
    color: #99abb4;
}

.stars-inner::before {
    content: "\f005 \f005 \f005 \f005 \f005";
    color: #f8ce0b;
}
/******/
</style>
<div class="tab-pane active show" id="overview" role="tabpanel">
    <div class="card-body">
        <h4 class="card-title text-dark font-weight-bold">Overview</h4>
        <p><?= @auth()->user_details->overview; ?></p>
        <h4 class="card-title text-dark font-weight-bold">Portpolio</h4>
        <p>Vitae eu urna proin vel ante a convallis donec mauris aliquam at. Duis dictum vel justo erat vitae. Et aenean consectetuer. Vel interdum consequat. Leo dolor aenean tortor in ultrices. Magna pede at. Non suspendisse erat magnis vehicula justo. Dis non tin</p>
        <h4 class="card-title text-dark font-weight-bold">Service Description</h4>
        <p><?= @auth()->user_details->overview; ?></p>
        <hr>
        <h4 class="card-title text-dark font-weight-bold"><?= (auth()->id != $this->uri->segment(2)) ? "My Reviews" : "Reviews"?></h4>
        <div class="card-body px-0">
            <!-- <div class="profiletimeline" id="my-review-comment">
                <?php foreach($review as $r): ?>
                    <?php if($r->review_id == auth()->id): ?>
                    <div class="pull-right">
                        <span class="text-warning"></span>
                        <ul class="d-inline-flex flex-row justify-content-start list-style-type-none mb-0 ml-1">
                            <?php for($i=0; $i<$r->rating; $i++): ?>
                                <li class="mr-1"><a href="#" class="text-warning ratings_stars"><i class="fa fa-star"></i></a></li>
                            <?php endfor; ?>
                            <?php for($i=0; $i<(5 - +$r->rating); $i++): ?>
                                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                    <div class="sl-item">
                        <div class="sl-left"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> </div>
                        <div class="sl-right">
                            <div><a href="#" class="link"><?= $r->user_details->fullname ?></a> <span class="sl-date"><?= $r->created_at ?></span>
                                <p><?= $r->message_review ?></p>
                                <!-- <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div> -->
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div> -->
        </div>
        <?php if(auth()->id != $this->uri->segment(2)): ?>
            <div class="d-flex flex-column">
                <div class="pull-right my-2">
                    <span class="text-warning">Ratings</span>
                    <ul class="d-flex justify-content-start ul-star list-style-type-none mb-0 ml-1">
                        <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                        <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                        <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                        <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                        <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                    </ul>

                </div>
                <?= form_open("reviews", array('id'=>'form-reviews','class'=>'form-material')); ?>
                    <textarea class="form-control" name="message_review" rows="5" placeholder="Write Review"></textarea>
                    <input type="hidden" name="rating" value="">
                    <input type="hidden" name="review_id" value="<?= $user->id ?>">
                    <div class="">
                        <button type="submit" class="pull-right mb-2 btn btn-primary">Submit</button>
                    </div>
                <?= form_close(); ?>
            </div>
            <hr>
        <?php endif; ?>
        <div class="card-body px-0">
            <div class="d-flex">
                <div class="col-3 d-flex flex-column align-items-center">
                    <h1 class="display-1 font-weight-bold"><?= $star['avarageRating'] ?></h1>
                    <div class="fa stars-outer">
                        <div class="fa stars-inner" style="width:<?= $star['percentageRating'] ?>%;">
                        </div>
                    </div>
                    <span><i class="fa fa-user"> <?= $star['countOverAll'] ?></i></span>
                </div>
                <div class="col-9">

                    <ul class="list-style-type-none mb-0 ml-1">
                        <li class="d-flex align-items-center mt-1">
                            <div class="">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="d-flex align-items-center justify-content-center ml-1"> 1</div>
                            <div class="px-1 ml-2   w-100"> - <?= $star['oneStar']; ?></div>
                        </li>
                        <li class="d-flex align-items-center mt-1">
                            <div class="">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class=""> 2</div>
                            <div class="px-1  ml-2   w-100"> - <?= $star['twoStar']; ?></div>
                        </li>
                        <li class="d-flex align-items-center mt-1">
                            <div class="">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="">3</div>
                            <div class="px-1 ml-2   w-100"> - <?= $star['threeStar']; ?></div>
                        </li>
                        <li class="d-flex align-items-center mt-1">
                            <div class="">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="">4</div>
                            <div class="px-1 ml-2   w-100"> - <?= $star['fourStar']; ?></div>
                        </li>
                        <li class="d-flex align-items-center mt-1">
                            <div class="">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="">5</div>
                            <div class="px-1 ml-2   w-100"> - <?= $star['fiveStar']; ?></div>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="profiletimeline" id="review-comment" data-id="<?= $user->id ?>"></div>
            <div class="pagination pagination-review-comment col-12 justify-content-center mb-4"></div>
        </div>



    </div>
</div>
