$(document).ready(function(){

    //init();
    var table = $("#jobs-invitation-container").initTable({
        url: '/jobs/invite',
        pageContainer: ".pagination-jobs-invitation-container",
        render: function(data) {
            var container = ``;
            if (data != null) {
                data.forEach(function(obj, index) {
                    console.log(obj);
                    container += `
                    <div class="sl-item">
                        <div class="sl-left">
                            <img src="data:image/png;base64,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" alt="" class="img-circle">
                        </div>
                        <div class="sl-right">
                            <big><a href="/jobs/${obj.id}" class="text-primary">${obj.title}</a></big>
                            <br>

                            <span class="sl-date">
                                Date recieve: 15 March 2018
                            </span>
                            <p>

                                Hi ,
                            </p>
                            <p>
                                ${obj.description}
                            </p>
                            <div class="row">

                                    <div class="col">
                                        <div class="mb2">
                                            <small class="text-secondary mb-0">BUDGET</small>
                                            <h4 class="text-primary font-weight-bold">$${obj.budget_min} - $${obj.budget_max}</h4>
                                        </div>
                                        <div class="mb2">
                                            <small class="text-secondary mb-0">STATUS</small>
                                            <h6 class="text-success font-weight-bold">Invitation</h6>
                                        </div>


                                    </div>
                                    <div class="col">
                                        <div class="mb2">
                                            <small class="text-secondary mb-0">Location</small>
                                            <h6 class="text-dark font-weight-bold">${obj.location}</h6>
                                        </div>
                                        <div class="mb2">
                                            <small class="text-secondary mb-0">FABRICATOR</small>
                                            <h6 class="text-dark font-weight-bold">Sushant</h6>
                                        </div>
                                    </div>
                                <div class="col">
                                        <div class="mb2">
                                            <small class="text-secondary mb-0">CATEGORY</small>
                                            <h6 class="text-dark font-weight-bold">Commercial</h6>
                                        </div>
                                        <div class="mb2">
                                            <small class="text-secondary mb-0">DISCIPLINE(S)</small>
                                            <h6 class="text-dark font-weight-bold">Structural</h6>
                                        </div>
                                    </div>
                                </div>
                            <div class="like-comm mt-4">
                                <a href="javascript:void(0)" class="link m-r-10"><i class="mdi mdi-check text-success"></i> Accept</a>
                                <a href="#" class="text-dark m-r-10" data-toggle="modal" data-target="#declineModal"><i class="mdi mdi-close  text-danger"></i> Decline</a>
                                <a href="#" class="text-dark m-r-10"><i class="mdi mdi-archive  text-primary"></i> Archived</a>
                                <a href="/jobs/my-job/1" class="text-dark"><i class="mdi mdi-eye-outline text-danger"></i> View Job Information</a>
                            </div>
                        </div>

                    </div>
                    <hr>
            `;
                });
            } else {
                container += `
                <div class="container d-flex justify-content-center align-items-center" style="height: 100px;">
                    <div class="row h-100 d-flex justify-content-center align-items-center">
                        <h1 class="text-dark ">NO JOB POST</h1>
                    </div>
                </div>
                `;
            }
            return container;
        }
    });
    $(document).on('submit', '#form-job-invitation', function(e){
        e.preventDefault();
        var url = $(this).attr("action");
        var data = $(this).serializeArray();
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            type: 'post',
            success: function(result){
                if(result.success){
                    window.location.href = "/jobs/invitations";
                }else{
                    window.location.reload();
                }
            },
            error: function(){

            }
        });
    });
});
