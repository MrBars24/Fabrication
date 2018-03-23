$(document).ready(function(){

setTimeout(function(){
    var t = $("#review-comment").initTable({
        url: '/reviews/'+ $('#review-comment').data('id'),
        pageContainer: ".pagination-review-comment",
        render: function(data) {

            var container = ``;
            if (data.length > 0) {
                data.forEach(function(obj, index) {
                    console.log(obj);
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
                        <div class="sl-left"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> </div>
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
                container += `hello`;
            }
            return container;
        }
    });
},1);

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
                    var ratings = (result.data.rating > 0) ? result.data.rating : 0;
                    var totalstar = 5 - +ratings;
                    var star = [];
                    for($i=0; $i<ratings;$i++){
                        star += `<li class="mr-1"><a href="#" class="text-warning ratings_stars"><i class="fa fa-star"></i></a></li>`;
                    }
                    for($i=0; $i<totalstar;$i++){
                        star += `<li class="mr-1"><a href="#" class="ratings_stars"><i class="fa fa-star"></i></a></li>`;
                    }
                    $('#review-comment').prepend(`
                        <div class="pull-right">
                            <span class="text-warning"></span>
                            <ul class="d-inline-flex flex-row justify-content-start ul-star list-style-type-none mb-0 ml-1">`
                                + star +
                            `</ul>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img src="../assets/images/users/1.jpg" alt="user" class="img-circle"> </div>
                            <div class="sl-right">
                                <div><a href="#" class="link">${result.user_details.fullname}</a> <span class="sl-date">1 sec ago</span>
                                    <p>${result.data.message_review}</p>
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
