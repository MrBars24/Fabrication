$(document).ready(function(){

    $(document).on("submit", "#form-send-discussion", function(e){
        e.preventDefault();
        var data = $(this).serializeArray();
        var url = $(this).attr('action');
        $.ajax({
            data: data,
            url: url,
            dataType: 'json',
            type: 'post',
            success: function(result){
                if(result.success){
                    $('.discussion-empty').remove();
                    $('.pagination-job-discussion-container').append(`
                        <div class="pull-right">
                            <span class="text-warning"></span>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img src="${result.data.user_details.user_details.avatar}" alt="user" class="img-circle"> </div>
                            <div class="sl-right">
                                <div><a href="#" class="link">${result.data.user_details.user_details.fullname}</a> <span class="sl-date">1 sec</span>
                                    <p>${result.data.message}</p>
                                    <!-- <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div> -->
                                </div>
                            </div>
                        </div>
                        <hr>
                    `);
                }
            },
            error: function(){

            }
        });
    });

    setTimeout(function(){
        var job_id = $(".pagination-job-discussion-container").data("id");
        var ta = $(".pagination-job-discussion-container").initTable({
            url: '/jobs/job-discussion/message/'+ job_id,
            pageContainer: ".pagination-job-discussion-bars",
            render: function(data) {
                var container = ``;
                if (data.length > 0) {
                    data.forEach(function(obj, index) {
                        container += `
                            <div class="pull-right">
                                <span class="text-warning"></span>
                            </div>
                            <div class="sl-item">
                                <div class="sl-left"> <img src="${obj.user_details.avatar_thumbnail}" alt="user" class="img-circle"> </div>
                                <div class="sl-right">
                                    <div><a href="#" class="link">${obj.user_details.fullname}</a> <span class="sl-date">${moment(obj.created_at).format('MMM D, YYYY')}</span>
                                        <p>${obj.message}</p>
                                        <!-- <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div> -->
                                    </div>
                                </div>
                            </div>
                            <hr>
                        `;
                    });
                } else {
                    container += `
                        <p class="text-center font-weight-bold discussion-empty">Be the first to Send a Discussion </p>
                    `;
                }
                return container;
            }
        });
    },2);


});
