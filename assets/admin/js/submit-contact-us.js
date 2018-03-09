$(document).on('submit','.contact-form',function( event ) {
	//event.preventDefault();
	//console.log( $( this ).serializeArray() );
	var contactData = $( this ).serializeArray();
	$.ajax({	
		url	: "/submit-contact-us",
		type : "POST",
		data : contactData,
		dataType: "JSON",
		success: function(contact){
			console.log(contact);
			$('.contact-form')[0].reset(); 
			//location.reload();
			
		},
	});
	
});