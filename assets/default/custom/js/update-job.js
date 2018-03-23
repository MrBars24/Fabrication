Dropzone.autoDiscover = false;
$(document).ready(function(){

    $('#psdate,#pedate,#bsdate,#bedate').bootstrapMaterialDatePicker({ format : 'YYYY-MM-D', time:false });

    // $(document).on("submit", "#form-update-job", function(e){
    //     e.preventDefault();
    //     var url = $(this).attr('action');
    //     var data = $(this).serializeArray();
    //
    //     $.ajax({
    //         type: 'post',
    //         url: url,
    //         data: data,
    //         dataType: 'json',
    //         success: function(data){
    //             window.location.reload();
    //             // $('.modal-job-edit').modal('hide');
    //             // $.each(data, function(index, field){
    //             //     location.reload();
    //             //  });
    //         },
    //         error: function(){
    //
    //         }
    //     });
    // });
    $(document).on("click", ".btn-removed-attach", function(){
        var id = $('.btn-removed-attach').data('target-id-attachment');
        $(this).parent().remove();
        var last_id = $('#input-removed-attachments-test').val();
        $('#input-removed-attachments-test').val( id + ","+ last_id);
        var id = "";
    });


    $(document).ready(function() {
        var url = $('#form-update-job').attr('action');
        var myDropzone = new Dropzone("#test1", {
            url: url,
            autoProcessQueue: false,
            maxFiles: 100,
            parallelUploads: 100,
            addRemoveLinks: true,
            paramName: "myFile", // The name that will be used to transfer the file
            uploadMultiple: true,
            //previewsContainer: '#my-awesome-dropzone',
            init:function(){
                var myDropzone = this;
                $(document).on("submit", "#form-update-job", function(e){

                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    }else{
                        $.ajax({
                            url:url,
                            type:"POST",
                            data : $("#form-update-job").serializeArray(),
                            success:function(res){
                                console.log(res);
                                //window.location.reload();
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
                    location.reload();

                    //window.location.href = "/jobs/posted";
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
                this.on("sending", function(file, xhr, formData,){
                    if($('input[name="removed_attach"]').val() != ""){
                        formData.append('removed_attach', $('input[name="removed_attach"]').val());
                    }
                    formData.append('title', $("input[name=title]").val());
                    formData.append('desc', $("textarea[name=desc]").val());
                    formData.append('max_budget', $("input[name=max_budget]").val());
                    formData.append('min_budget', $("input[name=min_budget]").val());
                    formData.append('location', $("input[name=location]").val());
                    formData.append('industry', $('select[name=industry] option:selected').val());
                    formData.append('tonnes', $('input[name=tonnes]').val());
                    formData.append('pstart', $('input[name=pstart]').val());
                    formData.append('pend', $('input[name=pend]').val());
                    formData.append('bend', $('input[name=bend]').val());
                    formData.append('bstart', $('input[name=bstart]').val());
                });
            }
        });


});
});
