$(document).ready(function(){
    var modaltest = $('.modal-invite-to-job').modalLoader();

    var table = $("#jobs-invitation-container").initTable({
        url: '/jobs/invite',
        pageContainer: ".jobs-invitation-pagination",
        render: function(data) {
            var container = ``;
            if (data.length > 0) {
                data.forEach(function(obj, index) {
                    var category = obj.category[0].display_name;
                    container += `<ul class="list-group list-group-flush">`;
                    container += `
                      <li class="list-group-item py-2">
                        <div class="row">
                          <div class="col-sm-8">
                            <h3 class="text-truncate"><a href="/jobs/${ obj.job_id }" class="text-primary">${ obj.title }</a></h3>
                            <h6 class="text-muted">Message from Client</h6>
                            <p class="text-truncate text-dark">${ obj.message }</p>
                          </div>
                          <div class="col-sm-4">
                            <h6 class="mb-0 text-muted">Date Received</h6>
                            <h5>${ moment(obj.created_at).format('MMM D, YYYY') }</h5>

                            <h6 class="mb-0 text-muted">Fabricator</h6>
                            <h5>${ obj.fullname }</h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12"><a href="#" class="text-dark m-r-10"><i class="mdi mdi-archive  text-primary"></i> Archive</a>
                          </div>
                        </div>
                      </li>
                    `;
                    container += `</ul>`;
                });
            } else {
                container += `
                  <div class="container d-flex justify-content-center align-items-center">
                      <div class="d-flex justify-content-center flex-column align-items-center py-4">
                          <h3 class="text-muted">You haven't received any invitation yet</h3>
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

        modaltest.load();
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            type: 'post',
            success: function(result){
                if(result.success){
                    toastr.success("Successfully send an invitation", "Success!!");
                    $('.modal-invite-to-job').modal('hide');
                    $('#form-job-invitation').trigger("reset");
                    modaltest.unload();
                    // window.location.href = "/jobs/invitations";
                }else{
                    modaltest.unload();
                    $('.modal-already-invite').modal('show');
                    $('.modal-invite-to-job').modal('hide');
                    $('#form-job-invitation').trigger("reset");
                }
            },
            error: function(){

            }
        });
    });

    $(document).on("click", ".btn-modal-invite", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var url = "/jobs/invite/"+ id;
        $("#form-job-invitation").attr("action", url);
    });
});
