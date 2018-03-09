$(document).ready(function(){

    $(document).on("submit","#form-fab",function(e) {
        e.preventDefault();
        var url = $('#form-fab').attr('action');
        var data = $('#form-fab').serializeArray();
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function(result){
                location.href = base_url + "settings";
            },
            error: function(){

            }


        });
    });

});
