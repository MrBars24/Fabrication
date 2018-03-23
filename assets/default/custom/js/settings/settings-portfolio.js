Dropzone.autoDiscover = false;
$(document).ready(function() {
    
$(document).on("submit", "#form-portfolio-create", function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    var data = $(this).serializeArray();
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: data,
        url: url,
        success: function(result){
                $('#myModal').modal('hide');
                $('#form-portfolio-create')[0].reset();
            var text = "You have successfully added your portfolio.";
            var heading = "Success";
            toastr.success(text, heading);
            $('#project-empty-error').html('');
            $("#portfolio-container").prepend(`<div class="col-sm-4" id="${result.id}">
                <div class="el-card-item">
                    <div class="el-card-avatar el-overlay-1 mb-1">
                        <img src="http://themedesigner.in/demo/admin-press/assets/images/big/img3.jpg" alt="user" class="img-fluid rounded">
                            <div class="el-overlay scrl-dwn">
                                <ul class="el-info">
                                    <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit" id="portfolio-link" data-toggle="modal" data-target-id = "${result.id}" data-target=".modal-view-portfolio">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit" id="portfolio-edit" data-toggle="modal" data-target-id = "${result.id}" data-target=".modal-edit-portfolio">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit" id="portfolio-delete" data-toggle="modal" data-target-id = "${result.id}" data-target=".modal-delete-portfolio">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </li>
                                </ul>
                            </div>
                    </div>
                    <div class="el-card-content text-left">
                        <h5 class="box-title">${data[0].value}</h5>
                    </div>
                </div>
            </div>`);
        },
        error: function(requestObject, error, errorThrown){
            console.log(requestObject);
            var title_input = $('title-input-error');
            var description_input = $('description-input-area');
            var error_title = requestObject.responseJSON.errors.title;
            var error_description = requestObject.responseJSON.errors.description;
            if (error_title && error_description != undefined){
                $("#title-error").html(`<h5 class="text-danger">`+error_title+`</h5>`);
                $("#description-error").html(`<h5 class="text-danger">`+error_description+`</h5>`);
            }
                
            else if (error_description != undefined){
                $("#description-error").html(`<h5 class="text-danger">`+error_description+`</h5>`);
                $("#title-error").html('');
            }
            else if (error_title != undefined){
                $("#title-error").html(`<h5 class="text-danger">`+error_title+`</h5>`);
                $("#description-error").html('');
            }
            else {
                $("#title-error").html('');
                $("#description-error").html('');
            }
            
            }
        
    });
});
    
    $(document).on("click","#portfolio-edit",function(e){
        e.preventDefault();
        var id = $(this).data('target-id');
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: '/portfolio/'+id,
            success: function(result){
                $('#edit-modal-header').html(`<h4 class="modal-title">Update Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>`);
                $('#edit-modal-body').html(`<form id="form-portfolio-update" data-target-id="${result.data.id}">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Project Name:</label>
                        <input type="text" name="project_name" value="${result.data.project_name}" class="form-control" id="title-input-error">
                        <label id="title-error"></label>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Description:</label>
                        <textarea name="description" class="form-control" id="description-input-area">${result.data.description}</textarea>
                        <label id="description-error"></label>
                    </div>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Save changes</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </form>`); 
            }
        });     
    });

    $(document).on("submit","#form-portfolio-update",function(e){
        e.preventDefault();
        var id = $(this).data('target-id');
        var data = $(this).serializeArray();
        $.ajax({
        data: data,
        type: 'post',
        dataType: 'json',
        url: '/portfolio/update/'+id,
        success: function (result){
            toastr.success('You have updated a portfolio', 'Success');
            $('#edit-portfolio').modal('hide');
            $('#form-portfolio-update')[0].reset();
            $("#"+id ).replaceWith(`<div class="col-sm-4" id="${id}">
                <div class="el-card-item">
                    <div class="el-card-avatar el-overlay-1 mb-1">
                            <img src="http://themedesigner.in/demo/admin-press/assets/images/big/img3.jpg" alt="user" class="img-fluid rounded">
                        <div class="el-overlay scrl-dwn">
                            <ul class="el-info">
                                <li>
                                    <button class="btn border-white btn-outline image-popup-vertical-fit" id="portfolio-link" data-toggle="modal" data-target-id = "${id}" data-target=".modal-view-portfolio">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                <li>
                                    <button class="btn border-white btn-outline image-popup-vertical-fit" id="portfolio-edit" data-toggle="modal" data-target-id = "${id}" data-target=".modal-edit-portfolio">
                                        <i class="icon-pencil"></i>
                                    </button>
                                </li>
                                <li>
                                <button class="btn border-white btn-outline image-popup-vertical-fit" id="portfolio-delete" data-toggle="modal" data-target-id = "${id}" data-target=".modal-delete-portfolio">
                                        <i class="icon-trash"></i>
                                    </button>
                                </li>
                                </ul>
                        </div>
                    </div>
                    <div class="el-card-content text-left">
                        <h5 class="box-title" id="portfolio-title">${data[0].value}</h5>
                    </div>
                </div>
            </div>`);
        },
        error: function(requestObject, error, errorThrown){
            console.log(requestObject);
            var title_input = $('title-input-error');
            var description_input = $('description-input-area');
            var error_title = requestObject.responseJSON.errors.project_name;
            var error_description = requestObject.responseJSON.errors.description;
            if (error_title && error_description != undefined){
                $("#title-error").html(`<h5 class="text-danger">`+error_title+`</h5>`);
                $("#description-error").html(`<h5 class="text-danger">`+error_description+`</h5>`);
            }
                
            else if (error_description != undefined){
                $("#description-error").html(`<h5 class="text-danger">`+error_description+`</h5>`);
                $("#title-error").html('');
            }
            else if (error_title != undefined){
                $("#title-error").html(`<h5 class="text-danger">`+error_title+`</h5>`);
                $("#description-error").html('');
            }
            else {
                $("#title-error").html('');
                $("#description-error").html('');
            }
            
            }
        });
    });

    $(document).on("click","#portfolio-delete",function(e){
        e.preventDefault();
        var id = $(this).data('target-id');
        $.ajax({
            success: function(result){
        $('#delete-modal-header').html(`<h3>Are you sure you want to delete?</h3>`);
        $('#delete-modal-footer').html(`
            <form id="portfolio-modal-delete" data-target-id="${id}"><button type="submit" id="${id}" class="btn btn-danger waves-effect waves-light">Yes</button></form>
            <button type="button" data-dismiss="modal" class="btn btn-default waves-effect waves-light">No</button>
            `);
            }
        });
    });

    $(document).on("click","#portfolio-modal-delete",function(e){
        e.preventDefault();
        var id = $(this).data('target-id');
        var data = $(this).serializeArray();
        $.ajax({
        data: data,
        type: 'post',
        dataType: 'json',
        url: '/portfolio/delete/'+id,
            success: function (result){
                if (!$('#portfolio-container').val()) {
                    $('#project-empty-error').html(`<h2 class="text-center text-muted">You haven't add any project yet.</h2>`);
              }
                $("#delete-portfolio").modal('hide');
                $("#"+ id).remove();
                toastr.error('You have deleted a porfolio.', 'Danger');
            }    
        });
    });


    $(document).on("click","#portfolio-link", function(e){
        e.preventDefault();
        var id = $(this).data('target-id');
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: '/portfolio/'+id,
            success: function(result){
                $('#modal-portfolio-header').html(`<h3 class="modal-title" id="myLargeModalLabel">${result.data.project_name}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>`);
                $('#modal-portfolio-body').html(`<div>
                    <h2 class="font-weight-bold">${result.data.project_name}</h2>
                    <div class="row">
                            <div class="col-sm-6">
                                <h6><span class="font-weight-bold">Industry: </span>Commercial</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6><span class="font-weight-bold">Project Start Date: </span>${result.data.created_at}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6><span class="font-weight-bold">Project End Date: </span>Dec 2019</h6>
                            </div>
                        </div>
                </div>
                    <div class="mt-3">
                        <div>
                            <p>${result.data.description}</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-4">
                                <img src="https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="" class="img-fluid">
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <img src="https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="" class="img-fluid">
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <img src="https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg?w=940&h=650&auto=compress&cs=tinysrgb" alt="" class="img-fluid">
                            </div>
                        </div>
                </div>`);
            
            },
                error: function(){

                }
        });            
    });
    
});
