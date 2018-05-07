$(document).ready(function () {

    init();

    function init() {
        var params = get_parameters();
        var $form = $('.card-search');

        if (params.txtsearch != "") {
            $form.find('[name="text-search"]').val(params.txtsearch);
        }
        if (params.category != "") {
            if ($form.find('[name="category"] option[value="' + params.category + '"]').length != 0) {
                // if ($("#category option[value='" + params.category + "']").length != 0) {
                $form.find('[name="category"]').val(params.category);
            } else {
                $form.find('[name="category"]').prop('selectedIndex', 0);
            }
        }
        if (params.country != "") {
            if ($form.find('[name="country"] option[value="' + params.country + '"]').length != 0) {
                // if ($("#country option[value='" + params.country + "']").length != 0) {
                $form.find('[name="country"]').val(params.country);
            } else {
                $form.find('[name="country"]').prop('selectedIndex', 0);
            }
        }
        if (params.rating != "") {
            if ($form.find('[name="rating"] option[value="' + params.rating + '"]').length != 0) {
                // if ($("#rating option[value='" + params.rating + "']").length != 0) {
                $form.find('[name="rating"]').val(params.rating);
            } else {
                $form.find('[name="rating"]').prop('selectedIndex', 0);
            }
        }
    }

    var table =  $(".pagination-members-container").initTable({
        url: '/hire/list',
        limit: 10,
        loaderContainer:'.loader-container',
        threshold:500,
        search: {
            txtsearch: $('.card-search input[name="text-search"]').val(),
            name: $('.card-search select[name="category"]').val(),
            country: $('.card-search select[name="country"]').val()
        },
        render: function (res) {
            var container = ``;
            if(res.length > 0){
                res.forEach(function (obj, index) {
                    var title = "";
                    var average = "";
                    var average_color = "";
                    var average_rating = obj.average_rating.substring(0,3);
                    var avatar_image = print_image(obj.avatar);
                    var adrs = "", cntry = "";
                    var invite = "";
                    var cat = "";
                    var exp = "";
                    if(obj.id == JSON.parse(localStorage.getItem('auth_user')).id) { invite = ""; }else{ invite = '<button class="btn btn-success btn-sm btn-modal-invite" data-id="'+ obj.id +'" data-toggle="modal" data-target=".modal-invite-to-job">Invite</button>'; }
                    if(obj.title == null || obj.title == "" || obj.title == undefined){ title = "No job title information" }else{ title = obj.title; }
                    if(obj.average_rating == 0 || obj.average_rating == "" || obj.average_rating == null){ average = "100"; } else{ average = ((obj.average_rating / (obj.review_count * 5)) * 100 ); }
                    if(obj.average_rating == 0 || obj.average_rating == "" || obj.average_rating == null){ average_color = "#99abb4"; } else{ average_color = "#f8ce0b"; }
                    if(obj.country_name == null){ cntry = "" } else{ cntry = obj.country_name }
                    if(obj.address == "" && obj.city == "" && obj.state == "" && obj.country_name == null) { adrs = "N/A" } else{ adrs = obj.address + " " + obj.city + " " + cntry  }
                    if(obj.work_type.length > 0){
                        for(i in obj.work_type){
                            cat += `<span class="badge badge-secondary">${obj.work_type[i].category}</span>`;
                        }
                    }else { cat = `<span class="badge badge-secondary">N/A</span>`; }

                    if(obj.user_expertise.length > 0){
                        for(i in obj.user_expertise){
                            exp += `<span class="badge badge-secondary">${obj.user_expertise[i].expertise}</span>`;
                        }
                    }else { exp =  `<span class="badge badge-secondary">N/A</span>`; }

                    container += `<div class="col-sm-6">
                            <div class="card">
                                <div class="justify-content-center d-flex px-5 mt-3">
                                    <img class="card-img-top img-responsive rounded-circle img-thumbnail hire-avatar" src="${avatar_image}" alt="user">
                                    <span class="hire-candidate-status"></span>
                                </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                          <h4 class="font-weight-bold mb-0"><a href="/members/${obj.user_id}">${obj.fullname}</a></h4>
                                          <h6 class="font-weight-bold d-block mt-1">${title}</h6>
                                        </div>

                                        <div class="row mt-3">
                                          <div class="col-sm-6">
                                            <small class="text-muted">Category</small>
                                            <div>
                                              ${cat}
                                            </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <small class="text-muted">Expertise</small>
                                            <div>
                                              ${exp}
                                            </div>
                                          </div>
                                          <div class="col-sm-6"></div>
                                        </div>
                                        <div class="mt-3">
                                          <div class="d-flex flex-direction-row justify-content-between align-items-center">
                                            <h6 class="m-0">Location:</h6>
                                            <span class="font-weight-bold one-line ml-3" data-toggle="tooltip" title="${adrs}">
                                                ${adrs}
                                            </span>
                                          </div>
                                          <div class="d-flex flex-direction-row justify-content-between align-items-center">
                                            <h6 class="m-0">Bids Won:</h6>
                                            <h6 class="font-weight-bold">${obj.my_win_bids}</h6>
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
                container = `
                <div class="container d-flex justify-content-center align-items-center" style="height: 100px;">
                    <div class="row h-100 d-flex justify-content-center align-items-center">
                        <h3 class="text-muted">No Result Found</h3>
                    </div>
                </div>`;
            }
            return container;
        }
    });

    $(document).on('change', '.card-search [name="category"], .card-search [name="country"], .card-search [name="rating"]', function() {
        searchMembers();
    });

    $(document).on('click', '#btnsearch', function(e) {
        e.preventDefault();
        searchMembers();
    });

    function searchMembers() {
        var $form = $('.card-search');
        var params = {
            'txtsearch': $form.find('[name="text-search"]').val(),
            'category': $form.find('[name="category"]').val(),
            'country': $form.find('[name="country"]').val(),
            'rating': $form.find('[name="rating"]').val(),
        };

        table.searchQuery(params);
        window.history.replaceState("", "Title", "/members?" + $.param(params));
    }

    $(document).on("submit", ".form-exp", function (e) {
        e.preventDefault();

        var $form = $(this);
        var url = $form.attr('action');
        var data = $form.serializeArray();


        // Hide the Errors (if it was shown previously)
        $form.find('.register-message').html('');

        // Disable the submit button
        $form.find('[type="submit"]').prop('disabled', true);
        $.ajax({
            type: 'post',
            url: url,
            dataType: 'json',
            data: data,
            success: function (result) {
                if (result.success) {
                    window.location.href = "register/verification";
                    // var $alert = $form.find('.register-message');
                    // $alert.html(`
                    //   <div class="alert alert-success fade in alert-dismissible show">
                    //      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    //       <span aria-hidden="true" style="font-size:20px">×</span>
                    //     </button>
                    //     <h4>You have successfully registered</h4>
                    //     <p>A verification link has sent to your email, Please verify it to activate your account!</p>
                    //   </div>
                    // `);
                    // $form.trigger('reset');
                }
                else {
                    var errors = '<ul class="mb-0 pl-4">';
                    $.each(result.errors, function (index, error) {
                        errors += `<li>${error}</li>`;
                    });
                    errors += '</ul>';

                    var $alert = $form.find('.register-message');

                    $alert.html(`
                    <div class="alert alert-danger fade in alert-dismissible show">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                      </button>
                      <h4>Oops!</h4>
                      <p>${ errors }</p>
                    </div>
                  `);

                    // Enable the submit button
                    $form.find('[type="submit"]').prop('disabled', false);
                }

            },
            error: function () {

            }

        });
    });

});
