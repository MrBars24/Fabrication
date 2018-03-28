<style>

.ul-star li a{
    color:#99abb4;
}

.ul-star li:hover ~ li .ratings_stars {
    color: #ddd;
}

.ul-star:hover  li a {
    color: yellow;
}

.ul-star .starstar {
  color: #6c757d;
}

/* prev siblings should be red */
.ul-star:hover .starstar {
  color: #ffc107;
}
.ul-star .starstar:hover,
.ul-star .starstar:hover ~ .starstar {
  color: #6c757d;
}

/******/
</style>
<div class="tab-pane active show" id="overview" role="tabpanel">
    <div class="card-body">
        <h4 class="card-title text-dark font-weight-bold">Overview</h4>
        <p><?= (auth()->user_details->overview == "") ? "" : auth()->user_details->overview; ?></p>
        <hr>
        <h4 class="card-title text-dark font-weight-bold">Portfolio</h4>
        <div class="col-12 text-center">
            <?php if(!empty($portfolio)): ?>
                <h3><?= $portfolio->project_name ?></h3>
                <p><?= $portfolio->description ?></p>
                <div class="d-flex flex-row">
                    <?php foreach($portfolio->attachments as $attachments): ?>
                        <div class="col-4">
                            <img class="img-fluid" src="<?= $attachments->path ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <!-- <h3>No portfolio post</h3> -->
            <?php endif; ?>
        </div>
        <hr>
        <h4 class="card-title text-dark font-weight-bold mt-2">Service Description</h4>
        <p><?= @auth()->user_details->overview; ?></p>
        <hr>
        <h4 class="card-title text-dark font-weight-bold">Reviews</h4>
        <?php if(auth()->id != $this->uri->segment(2)): ?>
            <?php if(empty($myGetReview)): ?>
                <div class="d-flex flex-column my-review-container">
                    <div class="pull-right my-2">
                        <span class="text-warning">Ratings</span>
                        <ul class="d-flex justify-content-start ul-star list-style-type-none mb-0 ml-1">
                            <li class="mr-1"><a href="#" class="starstar ratings_stars"><i class="fa fa-star"></i></a></li>
                            <li class="mr-1"><a href="#" class="starstar ratings_stars"><i class="fa fa-star"></i></a></li>
                            <li class="mr-1"><a href="#" class="starstar ratings_stars"><i class="fa fa-star"></i></a></li>
                            <li class="mr-1"><a href="#" class="starstar ratings_stars"><i class="fa fa-star"></i></a></li>
                            <li class="mr-1"><a href="#" class="starstar ratings_stars"><i class="fa fa-star"></i></a></li>
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
            <?php else: ?>
                <div class="profiletimeline my-review-container">
                    <div class="pull-right">
                        <span class="text-warning"></span>
                        <ul class="d-inline-flex flex-row justify-content-start list-style-type-none mb-0 ml-1">
                            <?php for($i=0; $i<$myGetReview->rating; $i++): ?>
                                <li class="mr-1"><a href="#" class="text-warning ratings_stars"><i class="fa fa-star"></i></a></li>
                            <?php endfor; ?>
                            <?php for($i=0; $i<(5 - +$myGetReview->rating); $i++): ?>
                                <li class="mr-1"><a href="#" class="text-muted ratings_stars"><i class="fa fa-star"></i></a></li>
                            <?php endfor; ?>
                        </ul>
                    </div>

                    <div class="sl-item">
                        <div class="sl-left"> <img src="<?= auth()->user_details->avatar_thumbnail ?>" alt="user" class="img-circle"> </div>
                        <div class="sl-right">
                            <div><a href="#" class="link"><?= auth()->user_details->fullname ?></a> <span class="sl-date"><?= time_new_format($myGetReview->created_at) ?></span>
                                <p><?= $myGetReview->message_review ?></p>
                                <div class="like-comm">
                                    <a href="javascript:void(0)" class="m-r-10 btn btn-info btn-xs text-white" data-toggle="modal" data-target="#exampleModal">Edit</a>
                                    <a href="javascript:void(0)" class="m-r-10 btn btn-danger delete-my-review btn-xs text-white" data-id="<?= $myGetReview->id ?>">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="card-body px-0">
            <div class="d-flex">
                <div class="col-3 d-flex flex-column align-items-center">
                    <h1 class="display-1 font-weight-bold"><?= (isset($star['avarageRating'])) ? $star['avarageRating'] : "0" ?></h1>
                    <div class="fa stars-outer">
                        <div class="fa stars-inner" style="width:<?= (isset($star['percentageRating'])) ? $star['percentageRating'] : "0" ?>%;">
                        </div>
                    </div>
                    <span><i class="fa fa-user"> <?= (isset($star['countOverAll'])) ? $star['countOverAll'] : "0" ?></i></span>
                </div>
                <div class="col-9">

                    <ul class="list-style-type-none mb-0 ml-1">
                        <li class="d-flex align-items-center mt-1">
                            <div class="">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="d-flex align-items-center justify-content-center ml-1"> 1</div>
                            <div class="px-1 ml-2   w-100"> - <?= (isset($star['oneStar'])) ? $star['oneStar'] : "0"; ?></div>
                        </li>
                        <li class="d-flex align-items-center mt-1">
                            <div class="">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class=""> 2</div>
                            <div class="px-1  ml-2   w-100"> - <?= (isset($star['twoStar'])) ? $star['twoStar'] : "0"; ?></div>
                        </li>
                        <li class="d-flex align-items-center mt-1">
                            <div class="">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="">3</div>
                            <div class="px-1 ml-2   w-100"> - <?= (isset($star['threeStar'])) ? $star['threeStar'] : "0"; ?></div>
                        </li>
                        <li class="d-flex align-items-center mt-1">
                            <div class="">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="">4</div>
                            <div class="px-1 ml-2   w-100"> - <?= (isset($star['fourStar'])) ? $star['fourStar'] : "0"; ?></div>
                        </li>
                        <li class="d-flex align-items-center mt-1">
                            <div class="">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="">5</div>
                            <div class="px-1 ml-2   w-100"> - <?= (isset($star['oneStar'])) ? $star['fiveStar'] : "0"; ?></div>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="profiletimeline" id="review-comment" data-id="<?= @$user->id ?>"></div>
            <div class="pagination pagination-review-comment col-12 justify-content-center mb-4"></div>
        </div>



    </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">New message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <?= form_open("reviews/update/$myGetReview->id", array('id'=>'form-reviews-update','class'=>'form-material')); ?>
                <div class="modal-body">
                    <div class=" my-2">
                        <span class="text-warning">Current Rate</span>
                        <ul class="d-inline-flex flex-row list-style-type-none mb-0 ml-1">
                            <?php for($i=0; $i<$myGetReview->rating; $i++): ?>
                                <li class="mr-1"><a href="#" class="text-warning ratings_stars"><i class="fa fa-star"></i></a></li>
                            <?php endfor; ?>
                            <?php for($i=0; $i<(5 - +$myGetReview->rating); $i++): ?>
                                <li class="mr-1"><a href="#" class="text-muted ratings_stars"><i class="fa fa-star"></i></a></li>
                            <?php endfor; ?>
                        </ul>

                    </div>
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
                    <textarea class="form-control" name="message_review" rows="5" placeholder="Write Review"><?= @$myGetReview->message_review ?></textarea>
                    <input type="hidden" name="rating" value="">
                    <input type="hidden" name="review_id" value="<?= $user->id ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
