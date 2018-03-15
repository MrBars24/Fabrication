$(document).ready(function(){

    var id = get_segment(2);
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
                toastr.success('Successfully Added Bid', 'Success!');
                var num = +$('.bid-count').html() + 1;
                $('.bid-count').html(num);
                $('.modal-bid-now').modal('hide');
                $('#bid-container').prepend(`
                    <li class="media border-0" data-mybid-id="${data.id.id}">
                        <img class="mr-3 rounded-circle" src="http://themedesigner.in/demo/admin-press/assets/images/users/8.jpg" width="64" alt="Generic placeholder image">
                        <div class="media-body">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4 class="mt-0 mb-1 font-weight-bold">${data.data.user_details.firstname} ${data.data.user_details.lastname}</h4>
                                    <small class="text-muted">1 sec ago</small>
                                </div>
                                <div class="col-sm-3 text-right">
                                </div>
                            </div>
                        </div>
                    </li>
                `);
                $('#card-bid-status').html(`
                    <div class="d-flex justify-content-center align-items-center card-body flex-column">
                        <h5 class="text-dark font-weight-bold">You already submitted a proposal </h5>
                            <div classs="d-flex">
                                <button type="button" class="btn btn-success btn-sm" data-target=".modal-view-bid" data-toggle="modal">Edit Proposal</button>
                                <button type="submit" class="btn btn-danger btn-sm cancel-bid" data-target-id="${data.id.id}">Cancel bid</button>
                            </div>
                    </div>`);
            },
            error: function(){

            }
        });
    });

    $(document).on('click',".btn-bookmark",function(){

        var that = $(this);
        that.removeClass('btn-bookmark');

        $.ajax({
            url:"/watchlist/" + id,
            type:"POST",
            success:function(res){
                if(res.success){
                    toastr.success('Added bookmark', 'Success!');
                    that.addClass('bg-danger text-white btn-unbook');
                }
            }
        })
    });

    $(document).on('click','.btn-unbook',function(){

        var that = $(this);
        that.removeClass('bg-danger text-white btn-unbook');

        $.ajax({
            url:"/watchlist/delete/" + id,
            type:"POST",
            success:function(res){
                if(res.success){
                    toastr.warning('Removed Bookmark', 'Warning!');
                    that.addClass('btn-bookmark');
                }
            }
        })
    });

    $(document).on('click', '.cancel-bid', function(e){
        e.preventDefault();

        var num = +$('.bid-count').html() - 1;
        $('.bid-count').html(num);
        var id = $(this).data('target-id');
        var url = '/job/bid/cancel/'+ id;
        $.ajax({
            url: url,
            dataType: 'json',
            type: 'get',
                success: function(result){
                if(result.success == true){
                    toastr.warning(' Removed a Bid', 'Warning!');
                    $('.media[data-mybid-id="'+result.id+'"]').remove();
                    $('#card-bid-status').html(`
                        <a class="text-white btn btn-success btn-lg btn-block" data-toggle="modal" data-target=".modal-bid-now">Bid Now</a>
                    `);
                }
            },
            error: function(){

            }
        });
    });

    $(document).on('submit','#form-edit-proposal', function(e){

        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            success: function(result){
                toastr.success('Successfully Edited bid', 'success!');
                $('.modal-view-bid ').modal('hide');
            },
            error: function(){

            }
        });
    });

});
