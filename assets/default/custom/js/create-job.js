Dropzone.autoDiscover = false;

$(document).ready(function() {

	var token = false;

	$("#expertise").select2({
		dropdownParent: $("#exampleModal"),
		tags: true,
		dropdownAutoWidth : true,
		width: '100%',
		ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
			url: "/settings/account/get-skills-job",
			dataType: 'json',
			quietMillis: 250,
		},
	});

	$('#pedate').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', time:false, minDate : new Date() })

	$('#psdate').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', time:false, minDate : new Date() })
		.on('change',function(e,date){
			var dt = date.add('days',1);
			$('#pedate').val("");
			$('#pedate').bootstrapMaterialDatePicker('setMinDate',dt);
		});

	$('#bedate').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', time:false, minDate : new Date() })
		.on('change',function(e,date){
			var dt = date.add('days',1);
			$('#psdate,#pedate').val("");
			$('#psdate').bootstrapMaterialDatePicker('setMinDate',dt);
			$('#pedate').bootstrapMaterialDatePicker('setMinDate',dt);
		});

	$('#bsdate').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD', time:false, minDate : new Date() })
		.on('change',function(e,date){
			var dt = date.add('days',1);
			$('#bedate').bootstrapMaterialDatePicker('setMinDate',dt);
		});


    var myDropzone = new Dropzone("#test", {
        url: "/jobs/create-job",
        autoProcessQueue: false,
		maxFiles: 5,
		maxFilesize: 50,
        parallelUploads: 10000,
        addRemoveLinks: true,
        paramName: "myFile", // The name that will be used to transfer the file
        uploadMultiple: true,
        data: $("#form-job-create").serializeArray(),
        //previewsContainer: '#my-awesome-dropzone',
        init:function(){

            var myDropzone = this;
            $(document).on("submit", "#form-job-create", function(e){
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
				if(!token){
					token = true;
	                if (myDropzone.getQueuedFiles().length > 0) {
	                    myDropzone.processQueue();
	                }else{
						var serial = $("#form-job-create").serializeArray();
						var exp = [];
						$("#expertise option:selected").each(function(i,item){
							var temp = $(item).attr("data-select2-tag");
							serial.push({
								name:'expertise[]',
								value: JSON.stringify({
									keystring : $(item).attr('value'),
									isNew : (temp != null) ? true : false
								})
							});
						});
	                    $.ajax({
	                        url:"/jobs/create-job",
	                        type:"POST",
	                        data : serial,
	                        success:function(res){
	                              if(!res.success){
	                                $('#modal-job-error').modal('show');
	                             }else{
	                                 window.location.href = "/jobs/posted";
	                             }
	                        }
	                    })
	                }
				}else{
					return;
				}

            });

            // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
            // of the sending event because uploadMultiple is set to true.
            this.on("sendingmultiple", function() {

            });

            this.on("successmultiple", function(files, response) {

            });

            this.on("success", function(file, responseText) {
                 if(responseText.success == false){
                    $('#modal-job-error').modal('show');
                 }else{
                     window.location.href = "/jobs/posted";
                 }

                // //console.log(responseText);
                // if(responseText.success=="true"){
                //     location.reload();
                // }else{
                //     $(".msg-container").html(responseText.msg);
                // }
            });
            this.on("error", function(files, response) {
                toastr.warning('Please try again!','Warning');
				token = false;
                this.removeAllFiles();
            });
            this.on("totaluploadprogress", function(progress) {
                //console.log(progress);
            });
            this.on("sending", function(file, xhr, formData){
				chkArray = [];
				$("input[name='material[]']:checkbox:checked").each(function() {
					chkArray.push($(this).val());
				});
                formData.append('title', $("input[name=title]").val());
                formData.append('description', $("textarea[name=description]").val());
                formData.append('budget_max', $("input[name=budget_max]").val());
                formData.append('budget_min', $("input[name=budget_min]").val());
                formData.append('city', $("input[name=city]").val());
                formData.append('country', $("select[name=country] option:selected").val());
                formData.append('state', $("input[name=state]").val());
                formData.append('industry', $('select[name=industry] option:selected').val());
                formData.append('bstart', $('input[name=bstart]').val());
                formData.append('bend', $('input[name=bend]').val());
                formData.append('pstart', $('input[name=pstart]').val());
                formData.append('pend', $('input[name=pend]').val());
                formData.append('tonnes', $('input[name=tonnes]').val());
				formData.append('material', JSON.stringify(chkArray));

				var serial = $("#form-job-create").serializeArray();
				var exp = [];
				$("#expertise option:selected").each(function(i,item){
					var temp = $(item).attr("data-select2-tag");
					formData.append('expertise[]', JSON.stringify({
						keystring : $(item).attr('value'),
						isNew : (temp != null) ? true : false
					}));
				});
                //formData.append('expertise', $('select[name=expertise] option:selected').val());
            });
        }
    });

    $(document).on("change","#tones" ,function(){
        if($(this).prop('checked') == true){
            $('.tones').prop("disabled", true);
        }else if($(this).prop('checked') == false){
            $('.tones').prop("disabled", false);
        }
    });


});
