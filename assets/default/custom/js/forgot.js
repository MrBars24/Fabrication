$(document).ready(function(){
	$(document).on("submit","#loginform",function(e){
		e.preventDefault();
		
		$.ajax({
			url : '/forgot-password/send',
			type:"POST",
			data:$(this).serialize(),
			success:function(res){
				if(res.success){
					//alert("Reset Password Email has been already sent.");
					$(".card-body").html("<h1>Reset Password Email has been already sent.<h1>");
					setInterval(function(){
						location.href = '/';
					},2000);
				}
			}
		})
	});
	
	$(document).on("submit","#resetform",function(e){
		e.preventDefault();
		
		var serial = $(this).serializeArray();
		serial.push({
			name:"q",
			value : get_parameters().q + "=="
		});
	
		$.ajax({
			url:'/forgot-password/confirm',
			type:"POST",
			data:serial,
			success:function(res){
				if(res.success){
					$(".card-body").html("<h1>Password has been reset.<h1>");
					setInterval(function(){
						location.href = '/';
					},2000);
				}
			}
		});
	})
});