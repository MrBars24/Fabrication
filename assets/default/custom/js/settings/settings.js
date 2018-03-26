$(document).ready(function(){

    $(document).on("click", "[data-toggle=edit-settings-input]", function(){
        $(this).html('Done');
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

});
