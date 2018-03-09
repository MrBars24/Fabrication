$(document).ready(function(){
	var index = null;
	$('#psdate,#pedate,#bsdate,#bedate').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', time:false });

	var table = $(".category-container").initTable({
		url:"/admin/jobs-category/list",
		pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			data.forEach(function(obj,index){
				container += `
					<tr>
						<td>${obj.display_name}</td>						
						<td>${obj.description}</td>
						<td>${moment(obj.created_at).format('MMM D, YYYY')}</td>
						<td>
							<a class="pointer edit"><i class="text-warning fa fa-pencil"></i></a>
							<a class="pointer delete"><i class="text-danger fa fa-trash"></i></a>
						</td>
					</tr>
				`;
			});

			return container;
		}
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
			url:'/admin/jobs-category/delete/' + data.id,
			type:'POST',
			success:function(res){
				if(res.success){
					table.dataRemove(index);
				}else{
					alert("failed");
				}
			}
		})
	});

	$(document).on('submit','#frm-category',function(e){
		e.preventDefault();
		var serial = $('#frm-category').serializeArray();
		var action = "/admin/jobs-category/create";
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
					
					var data = {
						data:d,
						template:`
							<tr>
								<td>${d.display_name}</td>
								<td>${d.description}</td>
								<td>${moment(d.created_at).format('MMM D, YYYY')}</td>
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
					}else{
						table.dataPrepend(data);
					}

					index = null;
					$('.create-modal').modal('toggle');
				}else{
					alert("failed");
				}
			}
		});
	});


	function loadModal(data){
		$(".create-modal").modal('show');
		$(".create-modal").find('form').attr('data-action','update');
		$(".create-modal").find('form').attr('action','/admin/jobs-category/update/' + data.id);
		$(".modal-title").text('Update Job Category');

		$("input[name='title']").val(data.display_name);
		$("textarea[name='desc']").val(data.description);
	}

});