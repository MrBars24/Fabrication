$(document).ready(function(){

    $(document).on("submit", "#form-login",function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function(result){
                window.location.href = result.data.url_redirect;
            },
            error: function(requestObject, error, errorThrown){
                //console.log(requestObject);
                if(requestObject.status == 401){
                    $.each(requestObject.responseJSON.error ,function(index, error){
                        if(error.name == "username"){
                            var target = $("#form-login input[name=" + error.name +"]").data('target-error-text');
                            $(target).parent().parent().removeAttr('hidden');
                            $(target).parent().parent().parent().parent().addClass('error');
                            $(target).html(error.message);
                        }
                        else if(error.name == "pwd"){
                            var target = $("#form-login  input[name=" + error.name +"]").data('target-error-text');
                            $(target).parent().parent().removeAttr('hidden');
                            $(target).parent().parent().parent().parent().addClass('error');
                            $(target).html(error.message);
                            $('#username-error').parent().parent().parent().parent().removeClass('error');
                            $('#username-error').parent().parent().attr('hidden', '');
                        }
                        else{
                        }
                    });
                }
            }
        });

    });
});
