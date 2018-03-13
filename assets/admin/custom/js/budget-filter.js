
$(document).ready(function(){
	var index = null;
	var table = $(".budget-container").initTable({
		url:"/admin/settings/budget-filter/list",
		pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			if(data != null){
				data.forEach(function(obj,index){
					obj.created_date = new Date(obj.created_date);
					obj.created_date = moment(obj.created_date).format('MM, DD YYYY - hh:mm A');
					obj.min_budget = obj.min_budget.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
					obj.max_budget = obj.max_budget.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
					container += `
						<tr>
							<td>Between</td>
							<td>${obj.min_budget}</td>
							<td>&</td>
							<td>${obj.max_budget}</td>
							<td>${obj.author}</td>
							<td>${obj.created_date}</td>
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


		$(document).on('submit','#frm-budget',function(e){
		e.preventDefault();
		var serial = $('#frm-budget').serializeArray();
		var action = "/admin/settings/budget-filter/create";
		var that = $(this);
		//check field
		var message
		var message;
	    message = document.getElementById("message");
	    message.innerHTML = "";
		var min_input = $("input[name='min_budget']").val();
		var max_input = $("input[name='max_budget']").val();
			try { 
		        if(min_input == "" || max_input == "")  throw "Fields cannot be empty!";
		        if(isNaN(min_input) || isNaN(max_input)) throw "The input is not a number";
		        min_input = Number(min_input);
		        max_input = Number(max_input);
		        if(min_input == max_input)    throw "Min Budget must be less than the Max Budget";
		    	if(min_input > max_input)    throw "Min Budget cannot be greater than the Max Budget";
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
					d.created_date = new Date(d.created_date);
					d.created_date = moment(d.created_date).format('MM, DD YYYY - hh:mm A');
					d.min_budget = d.min_budget.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
					d.max_budget = d.max_budget.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
					$('#no-results').remove('tr');
					var data = {
						data:d,
						template:`
							<tr>
							<td>Between</td>
							<td>${d.min_budget}</td>
							<td>&</td>
							<td>${d.max_budget}</td>
							<td>${d.author}</td>
							<td>${d.created_date}</td>
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
	$(document).on('click','.add',function(e){
		$("input[name='min_budget']").val('');
		$("input[name='max_budget']").val('');
		$("#message").html("");
	});

	$(document).on('click','.edit',function(e){
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
		index = $(this).parent().parent().index();
		var data = table.fetch(index);

		$.ajax({
			url:'/admin/settings/budget-filter/delete/' + data.id,
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


	function loadModal(data){
		$(".create-modal").modal('show');
		$(".create-modal").find('form').attr('data-action','update');
		$(".create-modal").find('form').attr('action','/admin/settings/budget-filter/update/' + data.id);
		$(".modal-title").text('Update Budget Filter Range');

		$("input[name='min_budget']").val(data.min_budget);
		$("input[name='max_budget']").val(data.max_budget);
	}

});