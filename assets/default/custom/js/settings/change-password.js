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
				if(res.success){
					toastr.success(res.message);
				}
			},
			error:function(xhr){
				if(xhr.status==400){
					toastr.warning(xhr.responseJSON.message);
				}
			}
		});
	});

});