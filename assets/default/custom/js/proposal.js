$(document).ready(function(){
    $(document).on('submit', '#form-proposal-submit', function(e){

        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();

        $.ajax({
            type: 'post',
            data: data,
            url: url,
            dataType: 'json',
            success: function(data){
                location.reload();
            },
            error: function(){

            }
        });
    });

});
