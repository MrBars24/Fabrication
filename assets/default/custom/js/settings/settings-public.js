$(document).ready(function(){

    $(document).on("click", "[data-toggle=edit-public-profile]", function(){
        $(this).html('Cancel');
        $(this).addClass('cancel-edit');
        var target = $(this).data('target');
        $(target).removeClass('d-none');
        $(target + '-hide').addClass('d-none');
    });

    $(document).on("click", ".cancel-edit", function(){
        $(this).html('Edit');
        $(this).removeClass('cancel-edit');
        var target = $(this).data('target');
        $(target).addClass('d-none');
        $(target + '-hide').removeClass('d-none');
    });
    $("#keywords").val();
    $("#keywords").tagsinput('items');

    $(document).on("submit", "#form-basic-update", function(e){
    e.preventDefault();
    var id = $(this).attr('target-id');
    var data = $(this).serializeArray();
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: data,
        url: 'settings/account/public-basic/'+ id,
        success: function(result){
            console.log(result);


        }
    });
    });


});