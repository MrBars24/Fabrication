$(document).ready(function(){

    $(document).on("click", ".ul-star li", function(e){
        e.preventDefault();
        var rate = $(this).index();
        $('#form-reviews input[name="rating"]').val(rate + 1);
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
                    $('#review-comment').prepend(`
                        <div class="pull-right">
                            <span class="text-warning"></span>
                            <ul class="d-inline-flex flex-row justify-content-start ul-star list-style-type-none mb-0 ml-1">
                                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                                <li class="mr-1"><a href="#" class=" ratings_stars"><i class="fa fa-star"></i></a></li>
                            </ul>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> </div>
                            <div class="sl-right">
                                <div><a href="#" class="link">John Doe</a> <span class="sl-date">1 sec ago</span>
                                    <p>${result.data.message_review}</p>
                                    <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    `);
                }else{
                    alert('error');
                }
            },
            error: function(){

            }
        });

    });

});
