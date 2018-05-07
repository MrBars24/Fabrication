$(".stickyside").stick_in_parent({
    offset_top: 100
});

$(document).ready(function(){

    var modaltest = $('.modal-invite-to-job').modalLoader();
    //init();
    var table =  $(".pagination-members-container").infiniteScroll({
        url: '/hire/list',
        limit: 10,
        loaderContainer:'.loader-container',
        threshold:500,
        render: function (res) {
            var container = ``;
            if(res.length > 0){
                res.forEach(function (obj, index) {
                    var title = "";
                    var average = "";
                    var average_color = "";
                    var average_rating = obj.average_rating.substring(0,3);
                    var avatar_image = print_image(obj.avatar);
                    var invite = "";
                    if(obj.id == JSON.parse(localStorage.getItem('auth_user')).id) { invite = ""; }else{ invite = '<button class="btn btn-success btn-sm btn-modal-invite" data-id="'+ obj.id +'" data-toggle="modal" data-target=".modal-invite-to-job">Invite</button>'; }
                    if(obj.title == null){ title = "No job title information" }else{ title = obj.title; }
                    if(obj.average_rating == 0 || obj.average_rating == "" || obj.average_rating == null){ average = "100"; } else{ average = ((obj.average_rating / (obj.review_count * 5)) * 100 ); }
                    if(obj.average_rating == 0 || obj.average_rating == "" || obj.average_rating == null){ average_color = "#99abb4"; } else{ average_color = "#f8ce0b"; }
                    container += `<div class="col-sm-6">
                            <div class="card">
                                <div class="justify-content-center d-flex px-5 mt-3">
                                    <img class="card-img-top img-responsive rounded-circle img-thumbnail hire-avatar" src="${avatar_image}" alt="user">
                                    <span class="hire-candidate-status"></span>
                                </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                          <h4 class="font-weight-bold mb-0"><a href="/members/${obj.user_id}">${obj.fullname}</a></h4>
                                          <h6 class="d-block mt-1">${title}</h6>
                                        </div>

                                        <div class="row mt-3">
                                          <div class="col-sm-6">
                                            <small class="text-muted">Category</small>
                                            <div>
                                              <span class="badge badge-secondary">Commercial</span>
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <small class="text-muted">Expertise</small>
                                            <div>
                                              <span class="badge badge-default">AutoCAD</span>
                                            </div>
                                          </div>
                                          <div class="col-sm-6"></div>
                                        </div>
                                        <div class="mt-3">
                                          <div class="d-flex flex-direction-row justify-content-between align-items-center">
                                            <h6 class="m-0">Location:</h6>
                                            <span class="font-weight-bold">${obj.city}</span>
                                          </div>
                                          <div class="d-flex flex-direction-row justify-content-between align-items-center">
                                            <h6 class="m-0">Job Completed:</h6>
                                            <span class="font-weight-bold">1</span>
                                          </div>
                                        </div>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                            ${invite}
                                            <!-- Rating Average -->
                                            <div>
                                                <small>
                                                <div class="fa stars-outer">
                                                    <div class="fa stars-inner" style="width:${average}%; color: ${average_color};">
                                                    </div>
                                                </div>
                                                <span class="text-warning">${average_rating}</span>
                                                </small>
                                            </div>
                                        <!-- End Rating Average -->
                                    </div>
                                </div>
                            </div>
                        </div>`;
                });
            }else{
                container = `<h1 class="text-center">NO JOBS POSTED</h1>`;
            }
            return container;
        }
    });
    // $(document).on('submit', '#form-job-invitation', function(e){
    //     e.preventDefault();
    //     var url = $(this).attr("action");
    //     var data = $(this).serializeArray();
    //
    //     modaltest.load();
    //     $.ajax({
    //         url: url,
    //         data: data,
    //         dataType: 'json',
    //         type: 'post',
    //         success: function(result){
    //             if(result.success){
    //                 toastr.success("Successfully send an invitation", "Success!!");
    //                 $('.modal-invite-to-job').modal('hide');
    //                 $('#form-job-invitation').trigger("reset");
    //                 modaltest.unload();
    //                 // window.location.href = "/jobs/invitations";
    //             }else{
    //                 modaltest.unload();
    //                 $('.modal-already-invite').modal('show');
    //                 $('.modal-invite-to-job').modal('hide');
    //                 $('#form-job-invitation').trigger("reset");
    //             }
    //         },
    //         error: function(){
    //
    //         }
    //     });
    // });
    //
    // $(document).on("click", ".btn-modal-invite", function(e){
    //     e.preventDefault();
    //     var id = $(this).data('id');
    //     var url = "/jobs/invite/"+ id;
    //     $("#form-job-invitation").attr("action", url);
    // });
});
