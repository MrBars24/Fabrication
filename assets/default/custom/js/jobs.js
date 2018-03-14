$(document).ready(function() {

    init();
    var table = $(".pagination-jobs-container").initTable({
        url: '/jobs/list',
        pageContainer: ".pagination-jobs-bars",
        search:{
            'status': $("[name='status']:checked").val(),
            'string': $("#search").val(),
            'category': $("#category").val(),
            'budget': $("#budget").val()
        },
        render: function(data) {
            var container = ``;
            if (data != undefined) {
                data.forEach(function(obj, index) {
                    console.log(obj);
                    container += `
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card" style="min-height: 400px;">
                    <div class="col-sm-12 text-right mt-3">
                            <button type="button" data-id="${obj.id}" class="btn ${(obj.is_watchlist == 1) ? "btn-outline-danger btn-unbook" : "btn-bookmark"} btn-circle"><i class="fa fa-bookmark"></i> </button>
                        </div>
                    <div class="card-body">
                        <h4 class="font-weight-bold mb-1 text-center">${obj.title}</h4>
                        <p class="text-secondary text-center">${obj.description}</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <small class="text-secondary mb-0">PROJECT STATUS</small>
                                    <h6 class="text-success text-uppercase font-weight-bold">${obj.status}</h6>
                                    <small class="text-secondary mb-0">DISCIPLINE(S)</small>
                                    <h6 class="text-dark font-weight-bold">Structural</h6>
                                    <small class="text-secondary mb-0">FABRICATOR</small>
                                    <h6 class="text-dark font-weight-bold"> ${obj.fullname} </h6>
                                </div>

                                <div class="col-sm-6">
                                    <small class="text-secondary mb-0">CATEGORY</small>
                                    <h6 class="text-dark font-weight-bold">${obj.bidding_type}</h6>
                                    <small class="text-secondary mb-0">BIDDING CLOSES</small>
                                    <h6 class="text-success font-weight-bold"><i class="fa fa-clock"></i> ${obj.bidding_expire_at}</h6>
                                    <small class="text-secondary mb-0">BIDS</small>
                                    <h6 class="text-dark font-weight-bold">${obj.accepted_bid}</h6>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="/jobs/${obj.id}" class="btn btn-warning text-dark mt-3 py-0 "><span class="align-middle">Job Details</span><i class="fa fa-angle-right fa-2x align-middle ml-2"></i></a>
                            </div>
                    </div>
                </div>
            </div>`;
                });
            } else {
                container += `
                <div class="container d-flex justify-content-center align-items-center" style="height: 100px;">
                    <div class="row h-100 d-flex justify-content-center align-items-center">
                        <h1 class="text-dark ">NO JOB POST</h1>
                    </div>
                </div>
                `;
            }
            return container;
        }
    });

    $(document).on('submit', '#form-update-job', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();

        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                // $.each(data, function(index, field){
                //     $('#form-update-job [data-value-target"'${field.name}'"] ').text(field.value);
                // });
            },
            error: function() {

            }
        });
    });

    $(document).on("click", "#btnsearch", function(e) {
        search_job();
    });

    $(document).on("change", "#category,#budget,[name='status']", function() {
        search_job();
    });

    $(document).on('click','.btn-bookmark',function(){
        var that = $(this);
        var index = that.attr("data-id");
        var data = table.dataFind("id",index);

        that.removeClass('btn-bookmark');
        $.ajax({
            url:"/watchlist/" + data.id,
            type:"POST",
            success:function(res){
                if(res.success){
                    that.addClass('btn-outline-danger btn-unbook');
                }
            }
        })
    });

    $(document).on('click','.btn-unbook',function(){
        var that = $(this);
        var index = that.attr("data-id");
        var data = table.dataFind("id",index);

        that.removeClass('btn-outline-danger btn-unbook');

        $.ajax({
            url:"/watchlist/delete/" + data.id,
            type:"POST",
            success:function(res){
                if(res.success){
                    that.addClass('btn-bookmark');
                }
            }
        })
    });

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

        table.search(params);
        window.history.replaceState("", "Title", "/jobs?" + $.param(params));
    }

    $(".stickyside").stick_in_parent({
        offset_top: 12
    });

    function init() {
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
});
