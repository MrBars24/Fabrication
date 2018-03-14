
Dropzone.autoDiscover = false;

$(document).ready(function() {
    var myDropzone = new Dropzone("#test", {
        url: "/jobs/create",
        autoProcessQueue: false,
        maxFiles: 100,
        parallelUploads: 100,
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
                if (myDropzone.getQueuedFiles().length > 0) {        
                    myDropzone.processQueue();
                }else{
                    $.ajax({
                        url:"/jobs/create",
                        type:"POST",
                        data : $("#form-job-create").serializeArray(),
                        success:function(res){
                            window.location.href = "/jobs/posted";
                        }
                    })
                }


            });

            // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
            // of the sending event because uploadMultiple is set to true.
            this.on("sendingmultiple", function() {
            //console.log("sendingmultiple");
            });

            this.on("successmultiple", function(files, response) {

            });

            this.on("success", function(file, responseText) {
                console.log(responseText);
                //console.log(responseText);
                window.location.href = "/jobs/posted";
                // if(responseText.success=="true"){
                //     location.reload();
                // }else{
                //     $(".msg-container").html(responseText.msg);
                // }
            });
            this.on("error", function(files, response) {
                $(".msg-container").html(response.msg);
                $('.dz-error-message').html("error");
               this.removeAllFiles();
            });
            this.on("totaluploadprogress", function(progress) {
                //console.log(progress);
            });
            this.on("sending", function(file, xhr, formData){
                formData.append('title', $("input[name=title]").val());
                formData.append('description', $("textarea[name=description]").val());
                formData.append('budget_max', $("input[name=budget_max]").val());
                formData.append('budget_min', $("input[name=budget_min]").val());
                formData.append('location', $("input[name=location]").val());
                formData.append('industry', $('select[name=industry] option:selected').val());
                formData.append('bidding', $('input[name=bidding]').val());
                formData.append('tonnes', $('input[name=tonnes]').val());
                formData.append('project', $('input[name=project]').val());
            });
        }
    });

});
