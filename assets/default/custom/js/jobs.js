$(document).ready(function() {

    var table = $(".pagination-jobs-container").initTable({
        url: '/jobs/list',
        pageContainer: ".pagination-jobs-bars",
        render:function(data){
        var container = ``;
        if(data != undefined){
            console.log(data);
        data.forEach(function(obj,index){
            container += `
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card" style="min-height: 400px;">
                    <div class="col-sm-12 text-right mt-3">
                            <button type="button" class="btn btn-outline-danger btn-circle"><i class="fa fa-bookmark"></i> </button>
                        </div>
                    <div class="card-body">
                        <h4 class="font-weight-bold mb-1 text-center">${obj.title}</h4>
                        <p class="text-secondary text-center">${obj.description}</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <small class="text-secondary mb-0">PROJECT STATUS</small>
                                    <h6 class="text-success font-weight-bold">Open for Bidding</h6>
                                    <small class="text-secondary mb-0">DISCIPLINE(S)</small>
                                    <h6 class="text-dark font-weight-bold">Structural</h6>
                                    <small class="text-secondary mb-0">FABRICATOR</small>
                                    <h6 class="text-dark font-weight-bold"> ${obj.user_details.fullname} </h6>
                                </div>

                                <div class="col-sm-6">
                                    <small class="text-secondary mb-0">CATEGORY</small>
                                    <h6 class="text-dark font-weight-bold">Commercial</h6>
                                    <small class="text-secondary mb-0">BIDDING CLOSES</small>
                                    <h6 class="text-success font-weight-bold"><i class="fa fa-clock"></i> ${obj.bidding_expire_at}</h6>
                                    <small class="text-secondary mb-0">BIDS</small>
                                    <h6 class="text-dark font-weight-bold">6</h6>
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

    $(document).on("click", "#btnsearch", function(e) {
        search_job();
    });

    $(document).on("change","#category,#budget,[name='status']",function(){
        search_job();
    });

    function search_job(){
        var txtsearch = $("#search").val();
        var search = $("#category").val();
        var budget = $("#budget").val();
        var status = $("[name='status']:checked").val();

        table.search({
            'string':txtsearch,
            'category':search,
            'budget':budget,
            'status':status
        });
    }

    $(".stickyside").stick_in_parent({
        offset_top: 12
    });
$(".stickyside").stick_in_parent({
    offset_top: 130
});
});

