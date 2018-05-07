$(document).ready(function(){

    setTimeout(function(){
        var t = $("#review-comment").initTable({
            url: '/reviews/'+ $('#review-comment').data('id'),
            pageContainer: ".pagination-review-comment",
            render: function(data) {

                var container = ``;
                if (data.length > 0) {
                    data.forEach(function(obj, index) {
                        var avatar = (obj.user_details.avatar_thumbnail == '' || obj.user_details.avatar_thumbnail == null || obj.user_details.avatar_thumbnail == undefined) ? "/assets/images/icon_profile.jpg" : obj.user_details.avatar_thumbnail;
                        var ratings = (obj.rating > 0) ? obj.rating : 0;
                        var totalstar = 5 - +ratings;
                        var star = [];
                        for($i=0; $i<ratings;$i++){
                            star += `<li class="mr-1"><a href="#" class="text-warning ratings_stars"><i class="fa fa-star"></i></a></li>`;
                        }
                        for($i=0; $i<totalstar;$i++){
                            star += `<li class="mr-1"><a href="#" class="text-muted ratings_stars"><i class="fa fa-star"></i></a></li>`;
                        }
                        container += `
                        <div class="pull-right">
                            <span class="text-warning"></span>
                            <ul class="d-inline-flex flex-row justify-content-start list-style-type-none mb-0 ml-1">`
                                + star +
                            `</ul>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img src="`+ avatar +`" alt="user" class="img-circle"> </div>
                            <div class="sl-right">
                                <div><a href="#" class="link">${obj.user_details.fullname}</a> <span class="sl-date">${obj.created_at}</span>
                                    <p>${obj.message_review}</p>
                                    <!-- <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div> -->
                                </div>
                            </div>
                        </div>
                        <hr>
                        `;
                    });
                } else {
                    container += ``;
                }
                return container;
            }
        });
    },1);

    $(document).on("click", ".ul-star li", function(e){
        e.preventDefault();
        var rate = $(this).index() + 1;
        var star = "";
        $('#form-reviews input[name="rating"]').val(rate);
        $('#form-reviews-update input[name="rating"]').val(rate);
        for($i=0; $i<rate;$i++){
            star += `<li class="mr-1"><a href="#" class="text-warning ratings_stars"><i class="fa fa-star"></i></a></li>`;
        }
        for($i=0; $i<(5 - rate);$i++){
            star += `<li class="mr-1"><a href="#" class="text-muted ratings_stars"><i class="fa fa-star"></i></a></li>`;
        }
        $('.justify-content-start').html(star);
    });

    $(document).on("click", ".delete-my-review", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var url = "/reviews/delete/" + id;
        $.ajax({
            url:url,
            dataType: 'json',
            type: 'get',
            success: function(result){
                if(result.success){
                    window.location.reload();
                    // toastr.warning('Successfully Removed Review', 'Warning!');
                    // $('.my-review-container').replaceWith(`
                    //     <div class="d-flex flex-column my-review-container">
                    //         <div class="pull-right my-2">
                    //             <span class="text-warning">Ratings</span>
                    //             <ul class="d-flex justify-content-start ul-star list-style-type-none mb-0 ml-1">
                    //                 <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                    //                 <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                    //                 <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                    //                 <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                    //                 <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                    //             </ul>
                    //
                    //         </div>
                    //         <form action="/reviews" method="post" id="form-reviews" class="form-material">
                    //             <textarea class="form-control" name="message_review" rows="5" placeholder="Write Review"></textarea>
                    //             <input type="hidden" name="rating" value="">
                    //             <input type="hidden" name="review_id" value="<?= $user->id ?>">
                    //             <div class="">
                    //                 <button type="submit" class="pull-right mb-2 btn btn-primary">Submit</button>
                    //             </div>
                    //         </form>
                    //     </div>
                    //     <hr>;
                    //`);
                }
            },
            error: function(){

            }
        });
    });

    $(document).on("submit", "#form-reviews", function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        $.ajax({
            data: data,
            url: url,
            dataType: 'json',
            type: 'post',
            success: function(result){
                if(result.success){
                    window.location.reload();
                    // var ratings = (result.data.rating > 0) ? result.data.rating : 0;
                    // var totalstar = 5 - +ratings;
                    // var star = [];
                    // for($i=0; $i<ratings;$i++){
                    //     star += `<li class="mr-1"><a href="#" class="text-warning ratings_stars"><i class="fa fa-star"></i></a></li>`;
                    // }
                    // for($i=0; $i<totalstar;$i++){
                    //     star += `<li class="mr-1"><a href="#" class="ratings_stars"><i class="fa fa-star"></i></a></li>`;
                    // }
                    // $('.my-review-container').replaceWith(`
                    //     <div class="profiletimeline my-review-container">
                    //         <div class="pull-right">
                    //             <span class="text-warning"></span>
                    //             <ul class="d-inline-flex flex-row justify-content-start list-style-type-none mb-0 ml-1">`
                    //                     + star +
                    //             `</ul>
                    //         </div>
                    //
                    //         <div class="sl-item">
                    //             <div class="sl-left"> <img src="${result.user_details.avatar_thumbnail}" alt="user" class="img-circle"> </div>
                    //             <div class="sl-right">
                    //                 <div><a href="#" class="link">${result.user_details.fullname}</a> <span class="sl-date">${result.created_at}</span>
                    //                     <p><?= $myGetReview->message_review ?></p>
                    //                     <div class="like-comm">
                    //                         <a href="javascript:void(0)" class="m-r-10 btn btn-info btn-xs text-white">Edit</a>
                    //                         <a href="javascript:void(0)" class="m-r-10 btn btn-danger delete-my-review btn-xs text-white" data-id="${result.id}">Delete</a>
                    //                     </div>
                    //                 </div>
                    //             </div>
                    //         </div>
                    //         <hr>
                    //     </div>
                    // `);
                }else{
                    alert('error');
                }
            },
            error: function(){

            }
        });

    });

    $(document).on("submit", "#form-reviews-update",function(e){
        e.preventDefault();
        var data = $(this).serializeArray();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            type: 'post',
            success: function(result){
                if(result.success){
                    window.location.reload();
                }else{
                    alert('error');
                }
            },
            error: function(){

            }
        });
    });

});
