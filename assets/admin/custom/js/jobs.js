$(document).ready(function(){
	var index = null;

	$('#psdate,#pedate,#bsdate,#bedate').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', time:false, minDate : new Date() });

	var table = $(".job-container").initTable({
		url:"/admin/job/list",
		pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			data.forEach(function(obj,index){
				container += `
					<tr>
						<td>${obj.title}</td>
						<td>${moment(obj.project_start).format('MMM D, YYYY')}</td>
						<td>${moment(obj.project_end).format('MMM D, YYYY')}</td>
						<td>${obj.budget_min} - ${obj.budget_max}</td>
						<td>
							<a class="pointer edit" data-toggle="tooltip" data-placement="top" title="Edit Job"><i class="text-warning fa fa-pencil"></i></a>
							<a class="pointer delete" data-toggle="tooltip" data-placement="top" title="Delete Job"><i class="text-danger fa fa-trash"></i></a>
						</td>
					</tr>
				`;
			});

			return container;
		},
		onBeforeRequest : function(){
			var loader = call_loader();
			$('.card').append(loader);
		},
		onSuccessRequest : function(){
			$('.loader-container').remove();
		}
	});

	$(document).on('keydown','.frm-search',function(e){
		if(e.keyCode == 13){
			table.search($(this).val());
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
			url:'/admin/jobs/delete/' + data.id,
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

	$(document).on('submit','#frm-job',function(e){
		e.preventDefault();
		var serial = $('#frm-job').serializeArray();
		var action = "/admin/jobs/create";
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
								<td>${d.title}</td>
								<td>${moment(d.project_start).format('MMM D, YYYY')}</td>
								<td>${moment(d.project_end).format('MMM D, YYYY')}</td>
								<td>${d.budget_min} - ${d.budget_max}</td>
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
		$(".create-modal").find('form').attr('action','/admin/jobs/update/' + data.id);
		$(".modal-title").text('Update Job');

		$("input[name='title']").val(data.title);
		$("input[name='industry']").val(data.bidding_type);
		$("textarea[name='desc']").val(data.description);
		$("input[name='bstart']").val(moment(data.bidding_start_at).format('YYYY-MM-DD'));
		$("input[name='bend']").val(moment(data.bidding_expire_at).format('YYYY-MM-DD'));
		$("input[name='pstart']").val(moment(data.project_start).format('YYYY-MM-DD'));
		$("input[name='pend']").val(moment(data.project_end).format('YYYY-MM-DD'));
		$("input[name='min_budget']").val(data.budget_min);
		$("input[name='max_budget']").val(data.budget_max);
	}

});