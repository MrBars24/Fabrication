
$(document).ready(function(){
	var index = null;

	var table = $(".news-container").initTable({
		url:"/admin/news/list",
		pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			if(data != null){
				data.forEach(function(obj,index){
					//obj.description = $(obj.description).text().substr(0,15);
					container += `
						<tr>
							<td>${obj.title}</td>
							<td>${obj.slug}</td>
							<td>${obj.author}</td>
							<td>${obj.created_date}</td>
							<td>
								<a class="pointer view"><i class="text-primary fa fa-eye"></i></a>
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


		$(document).on('submit','#frm-news',function(e){
		e.preventDefault();
		var serial = $('#frm-news').serializeArray();
		var action = "/admin/news/create";
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
							<tr>
								<td>${d.title}</td>
								<td>${d.slug}</td>
								<td>${d.author}</td>
								<td>${d.created_date}</td>
								<td>
									<a class="pointer view"><i class="text-primary fa fa-eye"></i></a>
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
			url:'/admin/news/delete/' + data.id,
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
		$(".create-modal").find('form').attr('action','/admin/news/update/' + data.id);
		$(".modal-title").text('Update News');

		$("input[name='title']").val(data.title);
		$("input[name='slug']").val(data.slug);
		$("textarea[name='desc']").val(data.description);
	}

	function viewModal(data){
		$(".view-modal").modal('show');
		$(".modal-title").text('News and Articles');

		$(".title").html(data.title);
		$(".slug").html(data.slug);
		$(".desc").html(data.description);
	}

if ($("#desc").length > 0) {
            tinymce.init({
                selector: "textarea#desc",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }


});