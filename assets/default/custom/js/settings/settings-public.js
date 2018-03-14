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

    $(document).on("click", "[data-toggle=edit-public-expertise]", function(){
        $(this).html('Cancel');
        $(this).addClass('cancel-edit-expertise');
        var target = $(this).data('target');
        $(target).removeClass('d-none');
        $(target + '-hide').addClass('d-none');
    });

    $(document).on("click", ".cancel-edit-expertise", function(){
        $(this).html('Edit');
        $(this).removeClass('cancel-edit-expertise');
        var target = $(this).data('target');
        $(target).addClass('d-none');
        $(target + '-hide').removeClass('d-none');
    });

    $(document).on("click", "[data-toggle=edit-public-specialization]", function(){
        $(this).html('Cancel');
        $(this).addClass('cancel-edit-specialization');
        var target = $(this).data('target');
        $(target).removeClass('d-none');
        $(target + '-hide').addClass('d-none');
    });
    
    $(document).on("click", ".cancel-edit-specialization", function(){
        $(this).html('Edit');
        $(this).removeClass('cancel-edit-specialization');
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
           
            
            $('#public-title').html(`${data[0].value}`);
            $('#public-overview').html(`${data[2].value}`);
            $('#public-service').html(`${data[3].value}`);
            var multikeywords =  $('#keywords').val();
            var splitmulti = multikeywords.split(",");
            $('.public-keywords').remove();
            $.each(splitmulti, function(index,field){
                $('#public-keywords-div').append(`<span class="public-keywords badge badge-secondary badge-pill mx-1 px-3 py-2 mb-1">` + field +`</span>`);
            }); 
        }
    });
    });

    $(document).on("submit", "#form-industry-update", function(e){
        e.preventDefault();
        
        var id = $(this).data('target-id');
        var data = $(this).serializeArray();
        var industry = new Array();
      
        $(" input:checked").each(function() {
            data.push($(this).val());
         });
        
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: data,
            url: '/settings/account/public-industries/'+ id,
            success: function(result){
                  
                var text = "You have successfully added your portfolio.";
                var heading = "Success!!";
                successtoast(text,heading);
            }
            
        });
        });
    
});