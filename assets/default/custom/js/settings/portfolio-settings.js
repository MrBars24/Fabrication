Dropzone.autoDiscover = false;
$(document).ready(function(){
    
        var myDropzone = new Dropzone("#drop-file", {
        url: "/settings/portfolio/create",
        autoProcessQueue: false,
        maxFiles: 100,
        parallelUploads: 100,
        addRemoveLinks: true,
        paramName: "myFile", // The name that will be used to transfer the file
        uploadMultiple: true,
        data: $("#form-portfolio-create").serializeArray(),
        //previewsContainer: '#my-awesome-dropzone',
        init:function(){

            var myDropzone = this;
            $(document).on("submit", "#form-portfolio-create", function(e){
                var serial = $('#form-portfolio-create').serializeArray();
		          var action = "/settings/portfolio/create";
                e.preventDefault();
                e.stopPropagation();
                if (myDropzone.getQueuedFiles().length > 0) {
                    myDropzone.processQueue();
                }else{
            $.ajax({
			url:action,
			type:'POST',
			data : serial
		});
                }


            });

            // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
            // of the sending event because uploadMultiple is set to true.
            this.on("sendingmultiple", function() {

            });

            this.on("successmultiple", function(files, response) {
                var that = $('#form-portfolio-create');
                if(!response.success){
                    $('#modal-job-error').modal('show');
                }else{
                    $('.create-modal').modal('toggle');
					var d = response.data;
					$('#no-results').remove('tr');
					var data = {
						data:d,
						template:`
                <div class="col-sm-4" id="portfolio-id">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1 mb-1">
                                <img src="http://themedesigner.in/demo/admin-press/assets/images/big/img3.jpg" alt="user" class="img-fluid rounded">
                            <div class="el-overlay scrl-dwn">
                                    <ul class="el-info">
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit view">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit edit">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit delete">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                        <div class="el-card-content text-center">
                            <h4 class="box-title" id="portfolio-title">${d.project_name}</h4>
                        </div>
                    </div>
                </div>
						`
					}
                    
					if(that.attr('data-action') == "update"){
                        data.index = index;
						table.dataReplace(data);
                        toastr.success('Portfolio updated', 'Success');
					}else{
						table.dataPrepend(data);
                        toastr.success('Portfolio added', 'Success');
					}

					index = null;
					
				
                }
            });

            this.on("success", function(file, responseText) {
                console.log(responseText.success);
                

                // //console.log(responseText);
                // if(responseText.success=="true"){
                //     location.reload();
                // }else{
                //     $(".msg-container").html(responseText.msg);
                // }
            });
            this.on("error", function(files, response) {
                $(".msg-container").html(response.msg);
                $('.dz-error-message').html("error");
               this.removeAllFiles();
            });
            this.on("totaluploadprogress", function(progress) {
                //console.log(progress);
            });
            this.on("sending", function(file, xhr, formData){
                formData.append('title', $("input[name=title]").val());
                formData.append('description', $("textarea[name=description]").val());
                formData.append('category', $("select[name=category] option:selected").val());
            });
        }
    });
    
	var index = null;
	var table = $("#portfolio-container").initTable({
		url:"/settings/portfolio/list",
		pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			if(data.length > 0){
				data.forEach(function(obj,index){
				container += `
                <div class="col-sm-4" id="portfolio-id">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1 mb-1">
                                <img src="http://themedesigner.in/demo/admin-press/assets/images/big/img3.jpg" alt="user" class="img-fluid rounded">
                            <div class="el-overlay scrl-dwn">
                                    <ul class="el-info">
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit view">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit edit">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit delete">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                        <div class="el-card-content text-center">
                            <h4 class="box-title" id="portfolio-title">${obj.project_name}</h4>
                        </div>
                    </div>
                </div>
			
					`
					;
				});
			}else{
				container = `<tr id="no-results">
								<td colspan="5">
									<div id="project-empty-error"  class="py-5">
                                           <h2   class="text-center text-muted">You haven't add any project yet.</h2>
                                    </div>
								</td>
							</tr>`;
			}

			return container;
		}
	});


/*		$(document).on('submit','#form-portfolio-create',function(e){
		e.preventDefault();
		var serial = $('#form-portfolio-create').serializeArray();
		var action = "/settings/portfolio/create";
		var that = $(this);
		if($(this).attr('data-action') == "update"){
			action = $(this).attr('action');
		}

		$.ajax({
			url:action,
			type:'POST',
			data : serial,
			success:function(res){
				if(res.success){
					var d = res.data;

					$('#no-results').remove('tr');
					var data = {
						data:d,
						template:`
                <div class="col-sm-4" id="portfolio-id">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1 mb-1">
                                <img src="http://themedesigner.in/demo/admin-press/assets/images/big/img3.jpg" alt="user" class="img-fluid rounded">
                            <div class="el-overlay scrl-dwn">
                                    <ul class="el-info">
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit view">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit edit">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="btn border-white btn-outline image-popup-vertical-fit delete">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                        <div class="el-card-content text-center">
                            <h4 class="box-title" id="portfolio-title">${d.project_name}</h4>
                        </div>
                    </div>
                </div>
						`
					}

					if(that.attr('data-action') == "update"){
						data.index = index;
						table.dataReplace(data);
                        toastr.success('Portfolio updated', 'Success');
					}else{
						table.dataPrepend(data);
                        toastr.success('Portfolio added', 'Success');
					}

					index = null;
					$('.create-modal').modal('toggle');
				}else{
					//$('.error-name').text(res.errors.training_name);
					//$('.error-desc').text(res.errors.description);
					//$('.error-start').text(res.errors.date_start);
					//$('.error-end').text(res.errors.date_end);
				}
			}
		});
	});*/
	$(document).on('click','.add',function(e,file){
		$("input[name='title']").val('');
		$("textarea[name='description']").val('');
        $("select[name= 'category'] option:selected");
        $(".create-modal").find('form').attr('data-action','');
		$(".modal-title").text('Add Project');
	});

	$(document).on('click','.edit',function(e){
		index = $(this).parents('#portfolio-id').index();
		var data = table.fetch(index);

		loadModal(data);
	});

	$(document).on('click','.view',function(e){
		index = $(this).parents('#portfolio-id').index();
		var data = table.fetch(index);

		viewModal(data);
	});

	$(document).on('click','.delete',function(e){
		index = $(this).parents('#portfolio-id').index();
		var data = table.fetch(index);
		$.ajax({
			url:'/settings/portfolio/delete/' + data.id,
			type:'POST',
			success:function(res){
				if(res.success){
					toastr.error('Portfolio Deleted', 'Danger')
                    table.dataRemove(index);
				}else{
					alert("failed");
				}
			}
		})
	});


	function loadModal(data){
		$(".create-modal").modal('show');
		$(".create-modal").find('form').attr('data-action','update');
		$(".create-modal").find('form').attr('action','/settings/portfolio/update/' + data.id);
		$(".modal-title").text('Update ' + data.project_name);

		$("input[name='title']").val(data.project_name);
		$("textarea[name='description']").val(data.description);
        var categoryName = $("select[name= 'category'] option").html();
        /*if (categoryName == data.display_name){
            console.log(data.display_name);
            $("select[name= 'category'] option:selected");
        }*/
            
	}
    
    function viewModal(data){
		$(".view-modal").modal('show');
		$(".view-modal").find('form').attr('data-action','update');
		$(".modal-title").text(data.project_name);
        
		$("label.view-name").text(data.project_name);
		$("label.view-desc").text(data.description);
	}
});
    
