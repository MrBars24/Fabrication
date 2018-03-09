$(document).ready(function(){
	$(".user-container").initTable({
		url:"/admin/user/list",
		pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			data.forEach(function(obj,index){
				container += `
					<tr>
						<td>${(obj.is_active == 1) ? "activated" : "inactive"}</td>
						<td>${obj.firstname} ${obj.lastname}</td>
						<td>${obj.email}</td>
						<td>${obj.user_type}</td>
						<td>
							<a href="/admin/users/edit/${obj.id}"><i class="text-warning fa fa-pencil"></i></a>
							<a class="pointer btn-delete" data-id="${obj.id}"><i class="text-danger fa fa-trash"></i></a>
						</td>
					</tr>
				`;
			});

			return container;
		}
	});

	$(document).on('click','.btn-delete',function(){
		var that = $(this);

		$.ajax({
			url:"/admin/users/delete/" + $(this).attr('data-id'),
			type:"POST",
			success:function(res){
				if(res.success){
					that.parent().parent().remove();
				}
			}
		});
	});

	$(document).on('submit','#frm-user-edit',function(e){
		e.preventDefault();

		var action = $(this).attr('action');
		var serial = $(this).serializeArray();

		$.ajax({
			url:action,
			data:serial,
			type:"POST",
			success:function(res){
				if(res.success){
					location.href = "/admin/users";
				}
			}
		});
	});

	$(document).on('submit','#frm-user-create',function(e){
		e.preventDefault();

		var action = $(this).attr('action');
		var serial = $(this).serializeArray();

		$.ajax({
			url:action,
			data:serial,
			type:"POST",
			success:function(res){
				if(res.success){
					location.href = "/admin/users";
				}
			}
		});
	});
});