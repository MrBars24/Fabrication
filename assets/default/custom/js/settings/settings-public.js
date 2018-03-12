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
    
    var id = $(this).data('target-id');
    var data = $(this).serializeArray();
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: data,
        url: '/settings/account/public-basic/'+ id,
        success: function(result){
            
            var text = "You have successfully added your portfolio.";
            var heading = "Success!!";
            successtoast(text,heading);
            console.log(data);
            
            $('#public-title').html(`${data[0].value}`);
            $('#public-overview').html(`${data[2].value}`);
            $('#public-service').html(`${data[3].value}`);
            var myArr = string.split(',');
            $('#public-keywords').replaceWith(`
            <span class="badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1">`+ results +`</span>`);
            
            
        }
    });
    });


});