$(document).ready(function(){

    $(document).on("submit", "#form-basic", function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function(result){
                // var text = "You have successfully change you're information";
                // var heading = "Success!!";
                // successtoast();
                toastr.success("You have successfully change you're information", "Success!!");
                $.each(data, function(index, field) {
                    if(field.name == "firstname"){
                        $('#form-basic [data-value-target="fullname"]').text(field.value);
                    }
                    else if(field.name == "lastname"){
                        $('#form-basic [data-value-target="fullname"]').text($('#form-basic [data-value-target="fullname"]').text() + " " + field.value);
                    }
                    else{
                        $('#form-basic [data-value-target="' + field.name + '"]').text(field.value);
                    }
                });

            },
            error: function(){

            }
        });
    });

    $(document).on("submit", "#form-industry", function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function(result){
                console.log(result);
            },
            error: function(){

            }
        });
    });

    $(document).on("submit", "#form-location", function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function(result){
                console.log(data);
                toastr.success("You have successfully change you're information", "Success!!");
                $.each(data, function(index, field) {
                    if(field.name == "country_id"){
                        var country_text = $('#form-location [name="country_id"]').children("option").filter(":selected").text();
                        $('#form-location [data-value-target="country_id"]').text(country_text);
                    }
                    else {
                        $('#form-location [data-value-target="' + field.name + '"]').text(field.value);
                    }
                });
            },
            error: function(result){
                console.log(result);
            }
        });
    });
});
