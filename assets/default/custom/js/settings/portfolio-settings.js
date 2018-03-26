Dropzone.autoDiscover = false;
$(document).ready(function(){
        var imageDelete = [];
        var ref = null;
        var action = '/settings/portfolio/create';
    var index = null;
    var table = $("#portfolio-container").initTable({
        url:"/settings/portfolio/list",
        pageContainer:".pagination-bars",
        render:function(data){
            var container = ``;
            if(data.length > 0){
                data.forEach(function(obj,index){
                    var path = (obj.attachments[0] == undefined) ? "/assets/images/placeholder-image.png" : obj.attachments[0].path;
                    container += `
                <div class="col-sm-4" id="portfolio-id">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1 mb-1">
                                <img src="`+ path +`" alt="user" class="img-fluid rounded">
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
                                           <h2   class="text-center text-muted">You haven't add any portfolio yet.</h2>
                                    </div>
                                </td>
                            </tr>`;
            }

            return container;
        }
    });
        var myDropzone = new Dropzone("#drop-file", {
        url: $('#form-portfolio-create').attr('action'),
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
                e.preventDefault();
                index = $(this).parents('#portfolio-id').index();
                var that = $('#form-portfolio-create');
                var serial = $('#form-portfolio-create').serializeArray();
                if($(this).attr('data-action') == "update"){
                    action = $('#form-portfolio-create').attr('action');
                    index = ref.parents('#portfolio-id').index();
                }
                if(imageDelete.length > 0){
                    serial.push({
                    name : 'attachments',
                    value : imageDelete
                });
                }
                
                e.stopPropagation();
                if (myDropzone.getQueuedFiles().length > 0) {
                    myDropzone.processQueue();
                }else{
            $.ajax({
			url:action,
			type:'POST',
			data : serial,
            success:function(res){
            if(res.success){
                var d = res.data;
                var path2 = (d.attachments[0] == undefined) ? "/assets/images/placeholder-image.png" : d.attachments[0].path;
                var data = {
                        data:d,
                        template:`
                <div class="col-sm-4" id="portfolio-id">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1 mb-1">
                                <img src="`+ path2 +`" alt="user" class="img-fluid rounded">
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
                    $('.create-modal').modal('toggle');
                        data.index = index;
                        table.dataReplace(data);
                        myDropzone.removeAllFiles(true);
                        toastr.success('Portfolio updated', 'Success');

                    }else{
                        table.dataPrepend(data);
                        myDropzone.removeAllFiles(true);
                        toastr.success('Portfolio added', 'Success');
                    }

                    index = null;
                    ref = null;
                    $('.create-modal').modal('toggle');
            }else{
            alert('failed');}
        }
		});
                }


            });

            // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
            // of the sending event because uploadMultiple is set to true.
            this.on("sendingmultiple", function() {

            });

            this.on("successmultiple", function(files, response) {
                 index = $(this).parents('#portfolio-id').index();
                 if($('#form-portfolio-create').attr('data-action') == "update"){
                    action = $('#form-portfolio-create').attr('action');
                    index = ref.parents('#portfolio-id').index();
                }
                var that = $('#form-portfolio-create');
                if(!response.success){
                    $('#modal-job-error').modal('show');
                }else{
                    $('.create-modal').modal('toggle');
					var d = response.data;
					$('#no-results').remove('tr');
                    var path = (d.attachments[0] == undefined) ? "/assets/images/placeholder-image.png" : d.attachments[0].path;
					var data = {
						data:d,
						template:`
                <div class="col-sm-4" id="portfolio-id">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1 mb-1">
                                <img src="`+ path +`" alt="user" class="img-fluid rounded">
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
                        myDropzone.removeAllFiles(true);
                        toastr.success('Portfolio updated', 'Success');

					}else{
						table.dataPrepend(data);
                        myDropzone.removeAllFiles(true);
                        toastr.success('Portfolio added', 'Success');
					}

					index = null;
					ref = null;
				
                }
            });

            this.on("success", function(file, responseText) {
                

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
                formData.append('attachments', imageDelete);

            });
        }
    });
    


	$(document).on('click','.add',function(e,file){
		$("input[name='title']").val('');
		$("textarea[name='description']").val('');
        $("select[name= 'category'] option:selected");
        $(".create-modal").find('form').attr('data-action','');
        $(".create-modal").find('form').attr('action','/settings/portfolio/create');
		$(".modal-title").text('Add Project');
        $('.image-container-edit').html('');
        myDropzone.removeAllFiles(true);
        myDropzone.options.url = '/settings/portfolio/create';
	});

	$(document).on('click','.edit',function(e){
		index = $(this).parents('#portfolio-id').index();
        ref = $(this);
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
    
    $(document).on('click','.delete-image',function(e){
        $(this).parents('#portfolio-id-modal').find('img').toggleClass('img-delete');
        index = $(this).parents('#portfolio-id-modal').index();
        $('.image-container-edit').dataRemove(index);

        var imageFetch =  $(this).parents('#portfolio-id-modal').find('.img-delete').attr('data-id');
        
        imageDelete.push(imageFetch);
    });


	function loadModal(data){
		$(".create-modal").modal('show');
		$(".create-modal").find('form').attr('data-action','update');
		$(".create-modal").find('form').attr('action','/settings/portfolio/update/' + data.id);
		$(".modal-title").text('Update ' + data.project_name);
        //action = '/settings/portfolio/update/' + data.id;
		$("input[name='title']").val(data.project_name);
		$("textarea[name='description']").val(data.description);
        $("select[name='category']").val(data.category);
        
        myDropzone.options.url = '/settings/portfolio/update/' + data.id;
        myDropzone.removeAllFiles(true);
        
        var imageCount = data.attachments;
			var container = ``;
			if(imageCount != null){
				imageCount.forEach(function(obj,index){
				container += `
                <div class="col-sm-4" id="portfolio-id-modal">
                    <div class="el-card-item">
                        <div class="el-card-avatar el-overlay-1 mb-1">
                                <img src="${obj.path}" data-id="${obj.imgid}" alt="user" class="img-fluid rounded">
                            <div class="el-overlay scrl-dwn">
                                    <ul class="el-info">
                                        <li>
                                            <a class="btn border-white btn-outline image-popup-vertical-fit delete-image">
                                                <i class="icon-trash"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
					`
					;
				});
			}else{
				container = `No Image`;
			}
        $('.image-container-edit').html(container);
    }
    
    function viewModal(data){
		$(".view-modal").modal('show');
		$(".view-modal").find('form').attr('data-action','update');
        $(".modal-title").text(data.project_name);

		$("label.view-name").text(data.project_name);
		$("label.view-desc").text(data.description);
        $("label.view-category").text(data.display_name);
        var imageCount = data.attachments;
			var container = ``;
			if(imageCount != null){
				imageCount.forEach(function(obj,index){
				container += `
                <div class="col-sm-6 col-lg-4 image">
                    <img src="${obj.path}" alt="" class="img-fluid my-3">
                </div>
					`
					;
				});
			}else{
				container = `No Image`;
			}
        $('.image-container-view').html(container);
	}
});
    
