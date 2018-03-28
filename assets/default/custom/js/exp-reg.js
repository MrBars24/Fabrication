$(document).ready(function(){



    $(document).on("submit","#form-exp",function(e){
        e.preventDefault();
        var url = $('#form-exp').attr('action');
        var data = $('#form-exp').serializeArray();

        $.ajax({
            type: 'post',
            url: url,
            dataType: 'json',
            data: data,
            success: function(result){
                if(result.success){
                    location.href = "/settings";
                }else{
                    alert("error");
                }

            },
            error: function(){

            }

        });
    });

});
