$(".stickyside").stick_in_parent({
    offset_top: 130
});

$(document).ready(function () {

	var loader = null;
    init();
    var table =  $("div.d-flex.row.pagination-jobs-container").infiniteScroll({
        url: '/work/list',
        limit: 10,
        loaderContainer:'.loader-container',
        threshold:400,
        search:{
            'status': $("[name='status']:checked").val(),
            'string': $("#search").val(),
            'category': $("#category").val(),
            'budget': $("#budget").val()
        },
        onSuccessRequest: function() {
			$('.pagination-jobs-container .read-more.loading').each(function(index,elem){
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
        render: function (data) {
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
                    <div class="col-6 col-job-card">
                        <a class="text-dark" href="/jobs/${obj.id}">
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
                                        			<button class="btn ${ (obj.is_watchlist == 1) ? "btn-danger btn-unbook"  : "btn-bookmark"} btn-sm" type="button"> ${ (obj.is_watchlist == 1) ? "Unmark"  : "Mark"} as watchlist </button>
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

    $(document).on('keydown','.frm-search',function(e){
        e.preventDefault();
        if(e.keyCode == 13){
            table.search($(this).val());
        }
    });

    $(document).on('click', '.btn-company-name', function(e){
        e.preventDefault();
        var url = $(this).data('window-location');
        window.location.href = url;
    });
	
	$(document).on("click",".read-more a",function(e){
		e.preventDefault();
		var link = 	$(this).parents(".text-dark").attr('href');
		location.href = link;
	});

    $(document).on('click','.btn-bookmark',function(e){
        e.preventDefault();
        var that = $(this);
        var index = that.parents(".col-job-card").index();
        var data = table.fetch(index);

        that.removeClass('btn-bookmark');
        $.ajax({
            url:"/watchlist/" + data.id,
            type:"POST",
            success:function(res){
                if(res.success){
                    that.addClass('bg-danger text-white btn-unbook');
					that.html('Unmark as watchlist');
                    toastr.success('Successfully added to watchlist.');
                }
            }
        })
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

    $(document).on('click','.frward',function(e){
        e.preventDefault();
		var url = location.origin + $(this).parents(".text-dark").attr('href');
		$(".frm-url").val(url);
        $('.frward-modal').modal('show');
    });

    $(document).on('click','.btn-unbook',function(e){
        e.preventDefault();
        var that = $(this);
        var index = that.parents(".col-job-card").index();
        var data = table.fetch(index);
        that.removeClass('bg-danger text-white btn-unbook');

        $.ajax({
            url:"/watchlist/delete/" + data.id,
            type:"POST",
            success:function(res){
                if(res.success){
                    that.addClass('btn-bookmark');
					that.html("Mark as watchlist");
					that.removeClass('btn-danger');
					toastr.success("Successfully Removed to watchlist");
                }
            }
        })
    });

	function validateEmail(email) {
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

    function init() {
		loader = $('.frward-modal').modalLoader();
		$("input.tags").tagsinput({
			maxTags: 10,
			confirmKeys : [13, 44]
		});

		$("input.tags").on('beforeItemAdd', function(event) {
			if(!validateEmail(event.item)){
				event.cancel = true;
			}
		  // event.item: contains the item
		  // event.cancel: set to true to prevent the item getting added
		});

        var params = get_parameters();
        if (params.q != "") {
            $("#search").val(params.q);
        }

        if (params.category != "") {
            if ($("#category option[value='" + params.category + "']").length != 0) {
                $("#category").val(params.category);
            } else {
                $("#category").prop('selectedIndex', 0);
            }
        }

        if (params.status != "") {
            if ($("[name='status'][value='" + params.status + "']").length != 0) {
                $("[name='status'][value='" + params.status + "']").prop('checked', true);
            } else {
                $("[name='status'][value='all']").prop('checked', true);
            }
        }

        if (params.budget != "") {
            if ($("#budget option[value='" + params.budget + "']").length != 0) {
                $("#budget").val(params.budget);
            } else {
                $("#budget").prop('selectedIndex', 0);
            }
        }
    }

    function search_job() {
        var txtsearch = $("#search").val();
        var search = $("#category").val();
        var budget = $("#budget").val();
        var status = $("[name='status']:checked").val();

        var params = {
            'string': txtsearch,
            'category': search,
            'budget': budget,
            'status': status
        };

        table.searchQuery(params);
        window.history.replaceState("", "Title", "/work?" + $.param(params));
    }

    $(document).on("click", "#btnsearch", function(e) {
        search_job();
    });

    $(document).on("change", "#category,#budget,[name='status']", function() {
        search_job();
    });

});
