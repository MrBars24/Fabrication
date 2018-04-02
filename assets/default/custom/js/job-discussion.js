$(document).ready(function(){
    setTimeout(function(){
        var job_id = $(".pagination-job-discussion-container").data("id");
        var ta = $(".pagination-job-discussion-container").initTable({
            url: '/jobs/job-discussion/message/'+ job_id,
            pageContainer: ".pagination-job-discussion-bars",
            render: function(data) {
                var container = ``;
                if (data.length > 0) {
                    data.forEach(function(obj, index) {
                        var is_session = (obj.is_session == 1) ? `<div class="btn-group btn-action-discussion">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-list"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btn-edit-discussion" href="javascript:void(0)" data-edit-discussion="${obj.id}">Edit</a>
                                    <a class="dropdown-item btn-dlt-discussion" href="javascript:void(0)" data-delete-discussion="${obj.id}">Delete</a>
                                </div>
                            </div>` : "";
                        container += `
                            <div class="">
                                <div class="pull-right">
                                    <span class="text-warning"></span>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left"> <img src="${obj.user_details.avatar_thumbnail}" alt="user" class="img-circle"> </div>
                                    <div class="sl-right">
                                        <div class="d-flex justify-content-between">
                                            <div class="col-11">
                                                <a href="#" class="link">${obj.user_details.fullname}</a> <span class="sl-date">${moment(obj.created_at).format('MMM D, YYYY')}</span>
                                                <p class="msg-container-disc" data-target-message="${obj.id}">${obj.message}</p>
                                                <!-- <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div> -->
                                            </div>
                                            <div class="col-1">`+is_session+`</div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
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
                    toastr.success("Successfully Added Job Discussion", "Success!");
                    $('.discussion-empty').remove();
                    $('.pagination-job-discussion-container').append(`
                        <div class="">
                            <div class="pull-right">
                                <span class="text-warning"></span>
                            </div>
                            <div class="sl-item">
                                <div class="sl-left"> <img src="${result.data.user_details.user_details.avatar}" alt="user" class="img-circle"> </div>
                                <div class="sl-right">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-11">
                                            <a href="#" class="link">${result.data.user_details.user_details.fullname}</a> <span class="sl-date">${moment(result.data.created_at).format('MMM D, YYYY')}</span>
                                            <p class="msg-container-disc"  data-target-message="${result.data.id}">${result.data.message}</p>
                                            <!-- <div class="like-comm"> <a href="javascript:void(0)" class="link m-r-10">2 comment</a> <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-heart text-danger"></i> 5 Love</a> </div> -->
                                        </div>
                                        <div class="col-1">
                                            <div class="btn-group btn-action-discussion">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-list"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item btn-edit-discussion" href="javascript:void(0)" data-edit-discussion="${result.data.id}">Edit</a>
                                                    <a class="dropdown-item btn-dlt-discussion" href="javascript:void(0)" data-delete-discussion="${result.data.id}">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    `);
                }
            },
            error: function(){

            }
        });
    });

    $(document).on("submit", "#form-edit-discussion", function(e){
        e.preventDefault();
        var data = $(this).serializeArray();
        var url = $(this).attr('action');
        var id = $("#form-edit-discussion").data('id');
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            type: 'post',
            success: function(result){
                if(result.success){
                    toastr.success("Successfully Edited Job Discussion", "Success!");
                    $('.btn-action-discussion').removeClass('d-none');
                    var id = $('#form-edit-discussion').data('id');
                    $('.msg-container-disc[data-target-message="'+ id +'"]').html(result.data.message);
                }else{
                    alert("something went wrong");
                }
            },
            error: function(){

            }
        });
    });

    $(document).on("click", ".btn-edit-discussion", function(e){
        e.preventDefault();
        var id = $(this).data("edit-discussion");
        var message = $('.msg-container-disc[data-target-message="'+ id +'"]').html();
        $('.btn-action-discussion').addClass('d-none');
        $('.msg-container-disc[data-target-message="'+ id +'"]').html(`
            <form action="/jobs/job-discussion/edit/`+ id +`" method="post" id="form-edit-discussion" data-id="`+id+`">
                <textarea class="form-control w-100 mt-2 textarea-message" cols="10" name="message" placeholder="Message here....">`+ message +`</textarea>
                <div class="col-12 text-right p-0">
                    <button type="submit" class="btn btn-info btn-sm">Save Changes</button>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-edit-discussion-cancel">Cancel</a>
                </div>
            </form>
        `);

    });

    $(document).on("click", ".btn-edit-discussion-cancel", function(e){
        e.preventDefault();
        $('.btn-action-discussion').removeClass('d-none');
        var id = $('#form-edit-discussion').data('id');
        var message = $('.textarea-message').html();
        $('.msg-container-disc[data-target-message="'+ id +'"]').html(message);
    });

    $(document).on("click", ".btn-dlt-discussion", function(e){
        e.preventDefault();
        var id = $(this).data('delete-discussion');
        var url = "/jobs/job-discussion/delete/"+ id;
        $.ajax({
            url: url,
            dataType: 'json',
            type: 'get',
            success: function(result){
                if(result.success){
                    toastr.success("Successfully Delete Job Discussion", "Success");
                    $('[data-delete-discussion="'+ id +'"] ').parent().parent().parent().parent().parent().parent().parent().remove();
                }else{
                    alert('failed');
                }
            },
            error: function(){

            }
        });
    });




});
