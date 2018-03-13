$(document).ready(function(){
    $('#psdate,#pedate,#bsdate,#bedate').bootstrapMaterialDatePicker({ format : 'YYYY-MM-D', time:false });
    $(document).on("submit", "#form-update-job", function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();

        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function(data){
                window.location.reload();
                // $('.modal-job-edit').modal('hide');
                // $.each(data, function(index, field){
                //     location.reload();
                //  });
            },
            error: function(){

            }
        });
    });

});
