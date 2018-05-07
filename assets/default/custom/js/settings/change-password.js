$(document).ready(function(){

	$(document).on('submit','.frm-card',function(e){
		e.preventDefault();
		var action = $(this).attr('action');
		var serial = $(this).serializeArray();

		$.ajax({
			url:action,
			data:serial,
			type:'POST',
			success:function(res){
				if(res.status){
				    $(".list-group-flush input").val("");
					toastr.success(res.message);
				}else{
                    toastr.error(res.message);
                }
			},
			error:function(xhr){
				if(xhr.status==400){
					toastr.warning(JSON.parse(xhr.responseText).message);
				}
			}
		});
	});

});