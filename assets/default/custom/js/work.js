$(".stickyside").stick_in_parent({
    offset_top: 130
});

$(document).ready(function () {

    init();
    var table =  $(".pagination-jobs-container").infiniteScroll({
        url: '/work/list',
        limit: 10,
        loaderContainer:'.loader-container',
        threshold:500,
        search:{
            'status': $("[name='status']:checked").val(),
            'string': $("#search").val(),
            'category': $("#category").val(),
            'budget': $("#budget").val()
        },
        render: function (data) {
            var container = ``;
            
            if(data.length > 0){
                data.forEach(function (obj, index) {
                    ago = compute_ago(obj.created_at);

                    container += `
                    <li class="list-group-item pt-4 pb-1">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0"><a href="/jobs/${obj.id}" class="text-dark">${obj.title}</a></h4>
                                <h6 class="text-muted mt-2">Posted ${moment(obj.created_at).format("MMMM DD, YYYY")}  - ${obj.bids} Bids</h6>
                                <h6 class="text-muted mt-2">Budget : ${obj.budget_min} - ${obj.budget_max}</h6>
                            </div>
                            <div>
                                <button class="${(obj.is_watchlist == 1) ? "bg-danger text-white btn-unbook" : "btn-bookmark"} btn btn-sm btn-circle "><i class="fa fa-bookmark"></i></button>
                                <button class="btn btn-sm btn-circle "><i class="mdi mdi-send"></i></button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 mr-0 col-lg-9">
                                <span class="badge badge-secondary px-2 py-1">${obj.project_category}</span>
                                <span class="badge badge-secondary px-2 py-1">${obj.approx_tonnes} tons</span>
                                <h6 class="text-dark mt-3 mb-3">
                                    <span class="mb-1">Location: ${obj.location}</span>
                                </h6>
                                <p>${obj.description}</p>
                                <div>
                                    <small>Fabricator:</small>
                                    <div class="d-flex justify-content-between">
                                         <h6 class="font-weight-bold"><a href="/members/1" class="text-dark">Company Name</a></h6>
                                    </div>

                                    <!--<div class="d-flex justify-content-start">
                                        <span class="text-warning">4.5</span>
                                        <ul class="d-inline-flex flex-row justify-content-start list-style-type-none mb-0 ml-1">
                                            <li class="mr-1"><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                            <li class="mr-1"><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                            <li class="mr-1"><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                            <li class="mr-1"><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                            <li class="mr-1"><a href="#" class="text-warning"><i class="fa fa-star"></i></a></li>
                                        </ul>                            <span class="text-muted ml-1">(12 reviews)</span>
                                    </div>-->
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-3">
                                <img src="https://thelogocompany.net/wp-content/uploads/2016/10/main_dlugos.jpg" alt="" class="img-fluid">
                                <a href="/jobs/${obj.id}" class="btn btn-success btn-block">View</a>
                            </div>
                        </div>

                        <div>
                            <ul class="list-style-type-none d-flex d-row justify-content-between mt-2">
                                <li>
                                    <h6 class="text-muted"></h6>
                                </li>
                                <li>
                                    <h6 class="text-muted"></h6>
                                </li>
                            </ul>
                        </div>
                    </li>`;
                });
            }else{
                container = `<h1 class="text-center">NO JOBS POSTED</h1>`;
            }
            return container;
        }
    });

    $(document).on('keydown','.frm-search',function(e){
        if(e.keyCode == 13){
            table.search($(this).val());
        }
    });

    $(document).on('click','.btn-bookmark',function(){
        var that = $(this);
        var index = that.parent().parent().parent().index();
        var data = table.fetch(index);
        that.removeClass('btn-bookmark');
        $.ajax({
            url:"/watchlist/" + data.id,
            type:"POST",
            success:function(res){
                if(res.success){
                    that.addClass('bg-danger text-white btn-unbook');
                    toastr.success('Successfully added to watchlist.');
                }
            }
        })
    });

    $(document).on('click','.btn-unbook',function(){
        var that = $(this);
        var index = that.parent().parent().parent().index();
        var data = table.fetch(index);
        that.removeClass('bg-danger text-white btn-unbook');

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

    function compute_ago(created){
        var a = $("meta[name=current]").attr("content");
        var ago = "";
        //console.log(a,created);
        if( moment(a).diff(created, 'seconds') > 0 ){
            ago = moment(a).diff(created, 'seconds') + " seconds ago";
        }

        if( moment(a).diff(created, 'minutes') > 0 ){
            ago = moment(a).diff(created, 'minutes') + " minutes ago";
        }

        if( moment(a).diff(created, 'hours') > 0 ){
            ago = moment(a).diff(created, 'hours') + " hours ago";
        }

        if( moment(a).diff(created, 'days') > 0 ){
            ago = moment(a).diff(created, 'days') + " days ago";
        }

        if( moment(a).diff(created, 'months') > 0 ){
            ago = moment(a).diff(created, 'months') + " months ago";   
        }

        if( moment(a).diff(created, 'years') > 0 ){
            ago = moment(a).diff(created, 'years') + " years ago";
        }
        //console.log(moment(a).diff(created, 'minutes'));
        return ago;
    }

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
        window.history.replaceState("", "Title", "/work?" + $.param(params));
    }

    $(document).on("click", "#btnsearch", function(e) {
        search_job();
    });

    $(document).on("change", "#category,#budget,[name='status']", function() {
        search_job();
    });

});
