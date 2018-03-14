$(document).ready(function() {
    var table = $(".pagination-watchlist-container").initTable({
        url: '/watch/list',
        pageContainer: ".pagination-jobs-bars",
        render: function(data) {
            var container = ``;
            if (data != undefined) {
                data.forEach(function(obj, index) {
                    //console.log();
                    container += `<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card" style="min-height: 400px;">
                        <div class="col-sm-12 text-right mt-3">
                            </div>
                            <div class="card-body little-profile text-center">
                            <div class="pro-img mt-1"><img src="../assets/images/users/4.jpg" alt="user" /></div>
                            <div class="card-body little-profile text-center">
                                <h4 class="font-weight-bold mb-1 text-center">${obj.title}</h4>
                                <p class="text-secondary text-center">${obj.description}</p>
                                <br />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <small class="text-secondary mb-0">PROJECT STATUS</small>
                                        <h6 class="text-success font-weight-bold">Open for Bidding</h6>
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
                                        <h6 class="text-dark font-weight-bold">${obj.bids}</h6>
                                    </div>
                                </div>
                            <div class="text-right">        
                                <a href="/jobs/${obj.id}" class="btn btn-warning text-dark mt-3 py-0 "><span class="align-middle">Job Details</span><i class="fa fa-angle-right fa-2x align-middle ml-2"></i></a>
                            </div>    
                            </div>
                        </div>
                    </div>
                </div>`;
                });
            } else {
                container += `
                <div class="container d-flex justify-content-center align-items-center" style="height: 100px;">
                    <div class="row h-100 d-flex justify-content-center align-items-center">
                        <h1 class="text-dark ">NO WATCHLIST</h1>
                    </div>
                </div>
                `;
            }
            return container;
        }
    });

});