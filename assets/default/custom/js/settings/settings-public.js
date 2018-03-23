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

    // $('.js-data-example-ajax').select2({
    //   ajax: {
    //     url: 'https://api.github.com/search/repositories',
    //     dataType: 'json'
    //     // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
    //   }
    // });

    // $_GET['q']
    // $.ajax({
    //     url: '/settigns/account/get-skills',
    //     dataType: 'json',
    //     type: 'get',
    //     success: function(data){
    //         console.log(data);
    //     },
    //     error: function(){
    //
    //     }
    // });

    $("#e6").select2({
        dropdownParent: $("#exampleModal"),
        tags: true,
        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
            url: "/settings/account/get-skills",
            dataType: 'json',
            quietMillis: 250,
        },
    });

    $(document).on("submit","#form-skills-create", function(e){
        e.preventDefault();
        var data = $(this).serializeArray();
        var url = $(this).attr('action');
        $.ajax({
            data: data,
            url: url,
            type: 'post',
            dataType: 'json',
            success: function(result){
                if (result.success == false){
                    $('.error-message').text(`${result.message}`);
                    $('#exampleModal').modal('hide');
                    $('#select2-e6-container').text('');
                }else{
                console.log(result);
                toastr.success('Skills Successfully Added', 'Success!');
                $('#exampleModal').modal('hide');
                $('#skills-container').prepend(`
                    <li data-id="${result.id}">
                        <h5 class="font-weight-bold">${result.data}</h5>
                    </li>
                `);
                $('#skills-container-edit').prepend(`
                    <li class="d-flex justify-content-between align-items-center mb-3" data-id="${result.id}">
                        <h5 class="font-weight-bold">${result.data}</h5>
                        <button type="button" class="btn btn-danger btn-delete-skill"  aria-haspopup="true" aria-expanded="false">
                            <i class="ti-trash"></i>
                        </button>
                    </li>
                `);
                $('.error-message').text(``);
                }
            },
            error: function(){

            }
        });
    });
    $(document).on("click", ".btn-delete-skill", function(){
        var id = $(this).parent().data('id');
        $.ajax({
            url: "/settings/skills/delete/"+id,
            dataType: 'json',
            type: 'get',
            success: function(data){
                if(data.success){
                    toastr.warning('Skills Successfully remove', 'Warning!');
                    $('li[data-id="'+id+'"]').remove();
                }else{
                    alert('Failed');
                }

            },
            error: function(){

            }
        });
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

    updateAvatar();

    function updateAvatar() {
        // Profile Photo Accepted Formats
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.png)$/;
        
        // var $cropperImage = $('#modal-crop-avatar .cropper-image');
        var $cropperImage = $('#form-upload-avatar .avatar-preview');

        $(document).on('submit', '#form-upload-avatar', saveAvatar);

        $(document).on('click', '#form-upload-avatar .select-file', function() {
            $(this).next('input[type="file"]').trigger('click');
        });

        $(document).on('change', '#form-upload-avatar input[name="image"]', function() {
            var $imageInput = $(this);

            if ($imageInput.val()) {

                // Check if valid file
                if (!regex.test($imageInput.val().toLowerCase())) {
                    $imageInput.val('');
                    toastr.error('Invalid File Selected', 'Warning');
                    return;
                }
          
                if (typeof (FileReader) == "undefined") {
                    toastr.error('File Reader not Supported', 'Warning');
                    return;
                }
          
                var reader = new FileReader();
                reader.onload = avatarImageLoaded;
                reader.readAsDataURL(this.files[0]);
              }

        });

        function avatarImageLoaded(e) {
            $cropperImage.attr('src', e.target.result);


            $cropperImage.cropper({
              aspectRatio: 1 / 1,
              viewMode: 1,
              minCropBoxWidth: 200,
              minCropBoxHeight: 200,
              center: true,
              scalable: true,
              dragMode: 'crop',
              crop: function(e) {
              }
            });

            $cropperImage.on({
                'zoom.cropper': function (e) {
                    e.preventDefault();
                }
            });
        }

        function saveAvatar(e) {
            e.preventDefault();

            $cropperImage.cropper('getCroppedCanvas').toBlob(function (croppedimg) {
                var formData = new FormData();
                formData.append('file', croppedimg, $('#form-upload-avatar input[name="image"]').val().split('\\').pop());
                formData.append('image_name', $('#form-upload-avatar input[name="image"]').val().split('\\').pop());
          
                $.ajax({
                    url: '/settings/account/avatar',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $cropperImage.cropper('destroy');
                        toastr.success('Profile Picture Updated', 'Success');
                        $cropperImage.attr('src', response.data.image);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        toastr.error('Something went wrong', 'Error');
                    }
                });
            });
        }
    }

});
