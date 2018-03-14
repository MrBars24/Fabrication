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
                var num = +$('.bid-count').html() + 1;
                $('.bid-count').html(num);
                $('.modal-bid-now').modal('hide');
                $('#bid-container').prepend(`
                    <li class="media border-0">
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
                    that.addClass('btn-bookmark');
                }
            }
        })
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
                $('.modal-view-bid').modal('hide');
            },
            error: function(){

            }
        });
    });

});
