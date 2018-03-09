$(".stickyside").stick_in_parent({
    offset_top: 100
});

$(document).ready(function () {
    var table =  $(".pagination-jobs-container").infiniteScroll({
        url: '/work/list',
        limit: 10,
        loaderContainer:'.container',
        threshold:500,
        render: function (data) {
            var container = ``;
            
            data.forEach(function (obj, index) {
                ago = compute_ago(obj.created_at);

                container += `
                <li class="list-group-item pt-4 pb-1">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0"><a href="/jobs/${obj.id}" class="text-dark">${obj.title}</a></h4>
                            <h6 class="text-muted mt-2">Posted ${moment(obj.created_at).format("MMMM DD, YYYY")}  - 25 Bids</h6>
                            <h6 class="text-muted mt-2">Budget : ${obj.budget_min} - ${obj.budget_max}</h6>
                        </div>
                        <div>
                            <button class="${(obj.is_watchlist == 1) ? "bg-danger text-white btn-unbook" : "btn-bookmark"} btn btn-sm btn-circle "><i class="fa fa-bookmark"></i></button>
                            <button class="btn btn-sm btn-circle "><i class="mdi mdi-send"></i></button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 mr-0 col-lg-9">
                            <span class="badge badge-secondary px-2 py-1">Commercial</span>
                            <span class="badge badge-secondary px-2 py-1">30 tons</span>
                            <h6 class="text-dark mt-3 mb-3">
                                <span class="mb-1">Location: Laguna, Philippines</span>
                            </h6>
                            <p>${obj.description}</p>
                            <div>
                                <small>Fabricator:</small>
                                <div class="d-flex justify-content-between">
                                     <h6 class="font-weight-bold"><a href="http://efab.ifltest08.tk/members/1" class="text-dark">Company Name</a></h6>
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
                            <a href="/jobs/${obj.id}" class="btn btn-success btn-block" target="_blank">View</a>
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
            return container;
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

});
