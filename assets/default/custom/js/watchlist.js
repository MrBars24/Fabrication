$(document).ready(function() {
    var table = $(".pagination-watchlist-container").initTable({
        url: '/watch/list',
        pageContainer: ".pagination-jobs-bars",
        render: function(data) {
            var container = ``;
            if (data != undefined) {
                data.forEach(function(obj, index) {
                    container += `<li class="list-group-item border-0 py-4" data-filter="${obj.budget}">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="font-weight-bold mb-1">${obj.title}</h5>
                                    <p class="text-secondary">${obj.description}</p>
                                    <a href="/jobs/${obj.id}" class="btn btn-warning text-dark mt-2 py-0 "><span class="align-middle">Job Details and Requirements</span><i class="fa fa-angle-right fa-2x align-middle ml-2"></i></a>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">

                                        <div class="col">
                                            <div class="mb2">
                                                <small class="text-secondary mb-0">BUDGET</small>
                                                <h4 class="text-primary font-weight-bold">$${obj.budget}</h4>
                                            </div>
                                            <div class="mb2">
                                                <small class="text-secondary mb-0">PROJECT STATUS</small>
                                                <h6 class="text-success font-weight-bold">Open for Bidding</h6>
                                            </div>
                                            <div class="mb2">
                                                <small class="text-secondary mb-0">CATEGORY</small>
                                                <h6 class="text-dark font-weight-bold">Commercial</h6>
                                            </div>
                                            <div class="mb2">
                                                <small class="text-secondary mb-0">DISCIPLINE(S)</small>
                                                <h6 class="text-dark font-weight-bold">Structural</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb2">
                                                <small class="text-secondary mb-0">BIDDING CLOSES</small>
                                                <h6 class="text-success font-weight-bold"><i class="fa fa-clock"></i> 22 August 2017</h6>
                                            </div>
                                            <div class="mb2">
                                                <small class="text-secondary mb-0">BIDS</small>
                                                <h6 class="text-dark font-weight-bold">6</h6>
                                            </div>
                                            <div class="mb2">
                                                <small class="text-secondary mb-0">FABRICATOR</small>
                                                <h6 class="text-dark font-weight-bold">Sushant</h6>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <i class="fa fa-bookmark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>`;
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