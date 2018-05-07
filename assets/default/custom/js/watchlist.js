$(document).ready(function() {
    var table = $(".pagination-watchlist-container").initTable({
        url: '/watch/list',
        pageContainer: ".pagination-jobs-bars",
        onSuccessRequest: function() {
            $('.pagination-watchlist-container .read-more.loading').each(function (index, elem) {
				var elem = $(this);
				elem.removeClass('loading');
				elem.ellipsis({
					lines: 3,             // force ellipsis after a certain number of lines. Default is 'auto'
					ellipClass: 'ellip',  // class used for ellipsis wrapper and to namespace ellip line
					responsive: true,      // set to true if you want ellipsis to update on window resize. Default is false
					lastLineText: `<a href="#">Read More ...</a>`
				});
				elem.find('.ellip').addClass('job-desc-min');
            })
        },
        render: function(data) {
            let container = ``;
            if(data.length > 0){
                data.forEach(function (obj, index) {
                    //console.log(obj);
                    var average = "";
                    var average_color = "";
                    if(obj.average_rating == 0 || obj.average_rating == "" || obj.average_rating == null){ average = "100"; } else{ average = (obj.average_rating * 20 ); }
                    if(obj.average_rating == 0 || obj.average_rating == "" || obj.average_rating == null){ average_color = "#99abb4"; } else{ average_color = "#f8ce0b"; }
                    var location = (obj.location == "" || obj.location == null) ? "No information" : obj.location;
                    var img = (obj.avatar == "" || obj.avatar == null || obj.avatar == undefined) ? "/assets/images/log_icon_gray.png" : obj.avatar;
                    var dt = format_date(obj.created_at);
                    var budget_m = (obj.budget_max == null || obj.budget_max == "") ? "" : " - "+ obj.budget_max;
                    var description = obj.description.substring(0,180);
                    var tonnes = (obj.approx_tonnes == 0) ? "Not sure" : obj.approx_tonnes;
                    container += `
                    <div class="col-4 col-job-card">
                        <a class="text-dark" href="/jobs/${obj.job_id}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-12 p-0">
                                        <div class="col-12 text-right p-0">
                                            <div class="d-flex justify-content-between">
                                                <div class="text-left col-6">
                                                    <small>Fabricator: <br><span class="font-weight-bold"><span data-window-location="/members/${obj.fabricator_id}" class="one-line text-dark btn-company-name">${obj.fullname}</span></span></small>
                                                    <div class="d-flex ">
                                                        <small>
															<div class="fa stars-outer">
																<div class="fa stars-inner" style="width:${average}%; color: ${average_color};">
																</div>
															</div>
                                                        </small>
														<!-- <br>
                                                        <small>(${obj.review_count} reviews)</small> -->
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                        			<button class="btn btn-danger btn-unbook btn-sm" type="button"> Unmark as watchlist </button>
													<button class="btn btn-sm frward mt-1" type="button">Forward to a friend</button>
                                                </div>
                                            </div>
                                            <div class="col-6 offset-3 p-3">
                                                <img src="${img}" alt="" class="img-fluid img-job">
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="card-title mb-0 job-title font-weight-bold text-dark one-line" data-toggle="tooltip" data-placement="top" title="${obj.title}">${obj.title}</h4>
                                    <h6 class="mb-0">${dt}</h6>
                                    <h6 class="text-muted pt-1 mb-0">Budget : $ ${obj.budget_min} ${budget_m} </h6>
                                    <div class=" job-description mt-2">
                                        <div class="read-more loading overflow-hidden">
                                          ${description}
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-6">
                                            <small>Industry:<span class="font-weight-bold"> <br>${obj.project_category}</span></small><br>
                                            <small>Tonnes:<span class="font-weight-bold"> ${tonnes}</span></small>
                                        </div>
                                        <div class="col-6 text-right">
                                            <h6 class="text-dark mt-1">
                                                <small class="d-block">Bids:<span class="font-weight-bold"> ${obj.bids}</span></small>
                                                <small class="d-block"><i class="fa fa-map-marker"></i><span class="font-weight-bold"> ${location}</span></small>
                                                <small class="d-block">Status: ${obj.status}</small>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</a>
                    </div>
                    `;
                });
            }else{
                container = `<h1 class="text-center">NO JOBS POSTED</h1>`;
            }
            return container;
        }
    });

    $(document).on('click','.btn-unbook',function(e){
        e.preventDefault();
        var that = $(this);
        var index = that.parent().parent().parent().index();
        var data = table.fetch(index);
        that.removeClass('bg-danger text-white btn-unbook');
        $.ajax({
            url:"/watchlist/delete/" + data.job_id,
            type:"POST",
            success:function(res){
                if(res.success){
                    table.dataRemoveByKey("id",data.job_id);
                    that.parent().parent().parent().parent().parent().parent().parent().parent().remove();
                    toastr.success("Successfully removed watchlist");
                }
            }
        })
    });

    $(document).on("click",".read-more a",function(e){
        e.preventDefault();
        var link = 	$(this).parents(".little-profile").find('.text-center a.btn-warning').attr('href');
        console.log(link);
        location.href = link;
    });
    $(document).on('click','.frward',function(e){
        e.preventDefault();
  		var url = location.origin + $(this).parents(".text-dark").attr('href');
  		$(".frm-url").val(url);
        $('.frward-modal').modal('show');
      });

  	$(document).on('submit','#frm-invite',function(e){
  		e.preventDefault();

  		if($(".tags").val().length <= 0) return false;
  		loader.load();

  		var serial = $(this).serializeArray();
  		serial.push({
  			name : 'emails',
  			value : $(".tags").val()
  		})
  		var action = $(this).attr('action');

  		$.ajax({
  			url : 'work/invite',
  			type : 'POST',
  			data : serial,
  			success : function(res){
  				if(res.success){
  					loader.unload();
  					$(".frward-modal").modal('toggle');
  					toastr.success('Email successfully been sent.');
  				}
  			}
  		})

  	});

  	$(".frward-modal").on('hidden.bs.modal',function(){
  		$('input.tags').tagsinput('removeAll');
  		$('textarea[name="message"]').val('');
  	});
});
