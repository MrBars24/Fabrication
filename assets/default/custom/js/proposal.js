$(document).ready(function(){
    var id = $('#job_id').val();
    var index = null;
    var url = "/jobs/bid-list/" + id;
	var table = $("#bid-container").initTable({
		url: url,
        pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			if(data.length > 0){
				data.forEach(function(obj,index){
                    var img = print_image(obj.avatar);
                    container += `
                        <li class="media border-0" data-mybid-id="${index}" data-my-id="${obj.id}">
                            <img class="mr-3 rounded-circle" src="${img}" width="64" alt="Generic placeholder image">
                            <div class="media-body">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <h4 class="mt-0 mb-0 font-weight-bold">${obj.fullname}</h4>
                                        <small class="text-muted time">${moment(obj.created_at).format('MMM D, YYYY')}</small>

                                    </div>
                                    <div class="col-sm-3 text-right">
                                </div>
                            </div>
                        </li>
					`
					;
				});
			}else{
			}

			return container;
		}
	});

     $(document).on('change','.bidding-filter', function(e){
        var bidFilter = $('.bidding-filter option:selected').text();
        e.preventDefault();
        if(bidFilter == 'Recent'){
            var url = "/jobs/bid-list/" + id+ "/" + 1;
        }else if(bidFilter == 'Lowest First'){
            var url = "/jobs/bid-list/" + id+ "/" + 2;
        }else if(bidFilter == 'Highest First'){
            var url = "/jobs/bid-list/" + id+ "/" + 3;
        }

        var table = $("#bid-container").initTable({
		url: url,
        pageContainer:".pagination-bars",
		render:function(data){
			var container = ``;
			if(data.length > 0){
				data.forEach(function(obj,index){
                    var img = print_image(obj.avatar);
                    obj.created_at = new Date(obj.created_at);
                    container += `
                            <li class="media border-0" data-mybid-id="${index}" data-my-id="${obj.id}">
                                <img class="mr-3 rounded-circle" src="${img}" width="64" alt="Generic placeholder image">
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <h4 class="mt-0 mb-0 font-weight-bold">${obj.fullname}</h4>
                                            <small class="text-muted time">${moment(obj.created_at).format('MMM D, YYYY')}</small>

                                        </div>
                                        <div class="col-sm-3 text-right">

                                        <small class="">Bid</small>
                                            <h4 class="amount">${obj.amount}</h4>
                                        </div>
                                    </div>
                                </div>
                            </li>
					`
					;
				});
			}
			return container;
		}
	});
});

    $(document).on('click', '.btn-decline-bid', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            type: 'get',
            url: url,
            dataType: 'json',
            success: function(result){
                $(url).parents('tr').remove();
                toastr.success("Successfully Decline Proposal", "Success");
            },
            error: function(){

            }
        });
    });

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
                if(data.success == false){

                    //return FALSE;
                    if(data.error == "budget"){
                        $(".budget_number").parent().addClass('error');
                        $(".field-budget").removeClass('d-none');
                    }else{
                        $('.modal-bid-now').modal('hide');
                        $('#modal-job-error').modal('show');
                    }
                }else{
                    $('#form-proposal-submit').trigger('reset');
                    $(".field-budget").addClass('d-none');
                    $(".budget_number").parent().removeClass('error');
                    toastr.success('Successfully Added Bid', 'Success!');
                    var num = +$('.bid-count').html() + 1;
                    var img = print_image(data.data.user_details.user_details.avatar);
                    $('.bid-count').html(num);
                    $('.modal-bid-now').modal('hide');
                    $('#bid-container').prepend(`
                        <li class="media border-0" data-mybid-id="${data.id.id}" data-my-id="${data.id.id}">
                            <img class="mr-3 rounded-circle" src="${img}" width="64" alt="Generic placeholder image">
                            <div class="media-body">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <h4 class="mt-0 mb-1 font-weight-bold">${data.data.user_details.firstname} ${data.data.user_details.lastname}</h4>
                                        <small class="text-muted">1 sec ago</small>
                                    </div>
                                    <div class="col-sm-3 text-right">
                                        <small class="">Bid</small>
                                        <h4 class="amount">${data.data.amount}</h4>
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
                    $('.modal-bid-edit-container').html(`
                        <div class="modal fade modal-view-bid" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="/jobs/edit/proposal/${data.id.id}" id="form-edit-proposal" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="myLargeModalLabel">Proposal</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?= $jobdata->id ?>" >
                                            <h5 class="font-weight-bold">Bid</h5>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="number" name="budget"  min="1" class="form-control form-control-lg" placeholder="Amount" value="${data.data.amount}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <small class="text-muted">Client's Budget</small>
                                                    <h4 class="font-weight-bold text-success m-0">$100 - $500</h4>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5 class="font-weight-bold">Additional Information</h5>
                                                <textarea class="form-control" rows="5" name="cover_letter">${data.data.cover_letter}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success waves-effect text-left">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    `);
                }
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
                    $('.media[data-my-id="'+result.id+'"]').remove();
                    $('#card-bid-status').html(`
                        <a class="text-white btn btn-success btn-lg btn-block" data-toggle="modal" data-target=".modal-bid-now">Bid Now</a>
                    `);
                    $('.modal-bid-edit-container').html(``);

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


	 $(document).on('click','#btn-close-bidding', function(e){

        e.preventDefault();
		var that = $(this);
        var id = $(this).data("job-id");
		var url = "/job/bid/close/"+ id;
		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
			success: function(result){
				//console.log(result);
				toastr.success('Job has been closed', 'success!');
				$("#job-status").text("close");
				$(".expire span").text(result.data.formatted_date);
				that.remove();
			},
			error: function(){

			}
		});

    });

    $(document).on('click', '#btn-finished-bidding', function(e){
        e.preventDefault();
        var that = $(this);
        var id = $(this).data("job-id");
        var url = "/job/bid/finish/"+ id;
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(res){
                // console.log(res);
                toastr.success('Job has been finished', 'success!');
                $('#job-status').text("finished");
                // $(".expire span").text(result.data.formatted_date);
                that.remove();
            },
            error: function(){

            }
        });
    });



});
