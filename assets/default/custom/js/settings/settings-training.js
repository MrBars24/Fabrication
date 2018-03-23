
$(document).ready(function(){
	var index = null;
	var table = $("#training-container").initTable({
		url:"/settings/training/list",
		pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			if(data.length > 0){
				data.forEach(function(obj,index){
                
					container += `
				<div id="training-id" class="list-group list-group-flush col-12">
                    <div class="list-group-item pb-4">
                        <h5 class="font-weight-bold mb-1">${obj.training_name}</h5>
                        <h6 class="text-muted"><small><span class="font-weight-bold">From</span> ${moment(obj.date_start).format('MMM D, YYYY')}</small> <small><span class="font-weight-bold">To</span> ${moment(obj.date_end).format('MMM D, YYYY')}</small></h6>
                        <h6>${obj.description}</h6>

                        <a href="#" class="btn btn-success view"><span class="align-middle">View</span><i class="icon-eye align-middle ml-2"></i></a>

                        <a href="#" class="btn btn-warning edit"><span class="align-middle">Edit</span><i class="icon-pencil align-middle ml-2"></i></a>

                        <a href="#" class="btn btn-deleted btn-danger text-white delete"><span class="align-middle">Delete</span><i class="icon-trash align-middle ml-2"></i></a>
            
                    </div>      
                </div>
					`
					;
				});
			}else{
				container = `<tr id="no-results">
								<td colspan="5">
									<h1 class="text-center">NO RESULTS FOUND</h1>
								</td>
							</tr>`;
			}

			return container;
		}
	});


		$(document).on('submit','#frm-training',function(e){
		e.preventDefault();
		var serial = $('#frm-training').serializeArray();
		var action = "/settings/training/create";
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
                <div id="training-id" class="list-group list-group-flush col-12">
                    <div class="list-group-item pb-4">
                        <h5 class="font-weight-bold mb-1">${d.training_name}</h5>
                        <h6 class="text-muted"><small><span class="font-weight-bold">From</span> ${d.date_start}</small> <small><span class="font-weight-bold">To</span> ${d.date_end}</small></h6>
                        <h6>${d.description}</h6>

                        <a href="#" class="btn btn-success view"><span class="align-middle">View</span><i class="icon-eye align-middle ml-2"></i></a>

                        <a href="#" class="btn btn-warning edit"><span class="align-middle">Edit</span><i class="icon-pencil align-middle ml-2"></i></a>

                        <a href="#" class="btn btn-deleted btn-danger text-white delete"><span class="align-middle">Delete</span><i class="icon-trash align-middle ml-2"></i></a>
                    </div>      
                </div>
						`
					}

					if(that.attr('data-action') == "update"){
						data.index = index;
						table.dataReplace(data);
                        toastr.success('Training updated', 'Success');
					}else{
						table.dataPrepend(data);
                        toastr.success('Training added', 'Success');
					}

					index = null;
					$('.create-modal').modal('toggle');
				}else{
					$('.error-name').text(res.errors.training_name);
					$('.error-desc').text(res.errors.description);
					$('.error-start').text(res.errors.date_start);
					$('.error-end').text(res.errors.date_end);
				}
			}
		});
	});
	$(document).on('click','.add',function(e){
        $('.error-name').text('');
        $('.error-desc').text('');
        $('.error-start').text('');
        $('.error-end').text('');
		$("input[name='training_name']").val('');
		$("textarea[name='description']").val('');
		$("input[name='date_start']").val('mm/dd/yyyy');
		$("input[name='date_end']").val('mm/dd/yyy');
	});

	$(document).on('click','.edit',function(e){
        $('.error-name').text('');
        $('.error-desc').text('');
        $('.error-start').text('');
        $('.error-end').text('');
		index = $(this).parent().parent().index();
		var data = table.fetch(index);

		loadModal(data);
	});

	$(document).on('click','.view',function(e){
		index = $(this).parent().parent().index();
		var data = table.fetch(index);

		viewModal(data);
	});

	$(document).on('click','.delete',function(e){
		index = $(this).parents('#training-id').index();
		var data = table.fetch(index);
		$.ajax({
			url:'/settings/training/delete/' + data.id,
			type:'POST',
			success:function(res){
				if(res.success){
					toastr.error('Training Deleted', 'Danger')
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
		$(".create-modal").find('form').attr('action','/settings/training/update/' + data.id);
		$(".modal-title").text('Update Training');

		$("input[name='training_name']").val(data.training_name);
		$("textarea[name='description']").val(data.description);
		$("input[name='date_start']").val(data.date_start);
		$("input[name='date_end']").val(data.date_end);
        console.log(data.date_end);
	}
    
    function viewModal(data){
		$(".view-modal").modal('show');
		$(".view-modal").find('form').attr('data-action','update');
		$(".modal-title").text('Training Information');
        
		$("label.view-name").text(data.training_name);
		$("label.view-desc").text(data.description);
		$("label.view-start").html(data.date_start);
		$("label.view-end").html(data.date_end);
	}
    

});