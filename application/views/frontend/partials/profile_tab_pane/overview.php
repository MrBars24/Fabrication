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
            <div class="profiletimeline" id="review-comment" data-id="<?= $user->id ?>"></div>
            <div class="pagination pagination-review-comment col-12 justify-content-center mb-4"></div>
        </div>



    </div>
</div>
