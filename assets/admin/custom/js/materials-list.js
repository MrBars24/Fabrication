$(document).ready(function(){
	var index = null;
	var table = $(".materials-container").initTable({
		url:"/admin/settings/materials-list/list",
		pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			if(data.length > 0){
				data.forEach(function(obj,index){
					obj.created_at = new Date(obj.created_at);
					obj.created_at = moment(obj.created_at).format('MM, DD YYYY - hh:mm A');
					container += `
						<tr class="hello">
							<td>${obj.material_name}</td>
							<td>${obj.added_by}</td>
							<td>${obj.created_at}</td>
							<td>
								<a class="pointer edit"><i class="text-warning fa fa-pencil"></i></a>
								<a class="pointer delete"><i class="text-danger fa fa-trash"></i></a>
							</td>
						</tr>
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


		$(document).on('submit','#frm-materials',function(e){
		e.preventDefault();
		var serial = $('#frm-materials').serializeArray();
		var action = "/admin/settings/materials-list/create";
		var that = $(this);
		//check field
		var message
		var message;
	    message = document.getElementById("message");
	    message.innerHTML = "";
		var material_error = $("input[name='material_name']").val();
			try { 
		        if(material_error == "")  throw "Fields cannot be empty!";
		    	}
		    catch(err) {
		        message.innerHTML = err;
		        return;
		    }

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
					d.created_at = new Date(d.created_at);
					d.created_at = moment(d.created_at).format('MM, DD YYYY - hh:mm A');
					$('#no-results').remove('tr');
					var data = {
						data:d,
						template:`
							<tr>
							<td>${d.material_name}</td>
							<td>${d.added_by}</td>
							<td>${d.created_at}</td>
								<td>
									<a class="pointer edit" data-index="${index}"><i class="text-warning fa fa-pencil"></i></a>
									<a class="pointer delete" data-id="${index}"><i class="text-danger fa fa-trash"></i></a>
								</td>
							</tr>
						`
					}

					if(that.attr('data-action') == "update"){
						data.index = index;
						table.dataReplace(data);
                        toastr.success('You have successfully updated a Material.', 'Success');
					}else{
						table.dataPrepend(data);
                        toastr.success('You have successfully added a Material.', 'Success');
					}

					index = null;
					$('.create-modal').modal('toggle');
				}else{
					alert("failed");
				}
			}
		});
	});
	$(document).on('click','.add',function(e){
		$("input[name='material_name']").val('');
        $(".create-modal").modal('show');
		$(".create-modal").find('form').attr('data-action','create');
		$(".modal-title").text('Add New Material');
	});

	$(document).on('click','.edit',function(e){
		index = $(this).parent().parent().index();
		var data = table.fetch(index);

		loadModal(data);
	});

	$(document).on('click','.delete',function(e){
		index = $(this).parent().parent().index();
		var data = table.fetch(index);

		$.ajax({
			url:'/admin/settings/materials-list/delete/' + data.id,
			type:'POST',
			success:function(res){

				if(res.success){
					table.dataRemove(index);
                    toastr.error('You have just deleted a  Material', 'Danger')
				}else{
					alert("failed");
				}
			}
		})
	});


	function loadModal(data){
		$(".create-modal").modal('show');
		$(".create-modal").find('form').attr('data-action','update');
		$(".create-modal").find('form').attr('action','/admin/settings/materials-list/update/' + data.id);
		$(".modal-title").text('Update Material');

		$("input[name='material_name']").val(data.material_name);
	}

});