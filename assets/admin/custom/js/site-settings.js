$(document).ready(function(){
	$(document).on("submit","#setting-update",function(e){
		e.preventDefault();
		var serial = $(this).serializeArray();
		var action = $(this).attr('action');

		var fd = new FormData(this);
		serial.forEach(function(item,i){
			fd.append(item.name,item.value);
		});

		$.ajax({
			url:action,
			data:fd,
			type:"POST",
			processData: false,
    		contentType: false,
			success:function(res){
				if(res.success){
					location.reload();
				}
			}
		})
	});
});