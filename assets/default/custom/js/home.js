$(document).ready(function() {
    $('#home-jobs-tabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab
        // $(target + ' .data-content-list').html(target);
        if($(e.target).hasClass('loaded')) {
            return;
        }

        var table = $(target + ' .data-content-list').initTable({
            url: '/jobs/recent',
            pageContainer: ".pagination-bid-history-bars",
            search:{
                'category': $(e.target).data('category'),
            },
            limit: 3,
            render: function(data) {
                var container = ``;
                if (data.length > 0) {
                    data.forEach(function(obj, index) {
                        container += `
                            <li class="list-group-item border-0 py-4">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5 class="font-weight-bold mb-1">${obj.title}</h5>
                                            <p class="text-secondary">${obj.description}</p>
                                            <a href="/jobs/${obj.id}" class="btn btn-warning text-dark mt-2 py-0"><span class="align-middle">Job Details and Requirements</span><i class="fa fa-angle-right fa-2x align-middle ml-2"></i></a>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb2">
                                                        <small class="text-secondary mb-0">DATE POSTED</small>
                                                        <h6 class="text-dark font-weight-bold">28 July 2017</h6>
                                                    </div>
                                                    <div class="mb2">
                                                        <small class="text-secondary mb-0">BUDGET</small>
                                                        <h6 class="text-dark font-weight-bold">$${obj.budget_min} - $${obj.budget_max}</h6>
                                                    </div>
                                                    <div class="mb2">
                                                        <small class="text-secondary mb-0">APPROX. TONNES</small>
                                                        <h6 class="text-dark font-weight-bold">${obj.approx_tonnes}t</h6>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb2">
                                                        <small class="text-secondary mb-0">PROJECT STATUS</small>
                                                        <h6 class="text-success text-capitalize font-weight-bold">${obj.status}</h6>
                                                    </div>
                                                    <div class="mb2">
                                                        <small class="text-secondary mb-0">CATEGORY</small>
                                                        <h6 class="text-dark font-weight-bold">${obj.project_category}</h6>
                                                    </div>
                                                    <div class="mb2">
                                                        <small class="text-secondary mb-0">DISCIPLINE(S)</small>
                                                        <h6 class="text-dark font-weight-bold">Structural</h6>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb2">
                                                        <small class="text-secondary mb-0">BIDDING CLOSES</small>
                                                        <h6 class="text-success font-weight-bold"><i class="fa fa-clock"></i> ${obj.bidding_expire_at}</h6>
                                                    </div>
                                                    <div class="mb2">
                                                        <small class="text-secondary mb-0">BIDS</small>
                                                        <h6 class="text-dark font-weight-bold">${obj.bids}</h6>
                                                    </div>
                                                    <div class="mb2">
                                                        <small class="text-secondary mb-0">FABRICATOR</small>
                                                        <h6 class="text-dark font-weight-bold">${obj.fullname}</h6>
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <i class="fa fa-bookmark"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        `;
                    });
                } else {
                    container = `
                    <div class="container d-flex justify-content-center align-items-center" style="height: 100px;">
                        <div class="row h-100 d-flex justify-content-center align-items-center">
                            <h1 class="text-dark ">No Result</h1>
                        </div>
                    </div>
                    `;
                }
                console.log(container);
                return container;
            }
        });

        $(e.target).addClass('loaded');
    });

    $('#home-jobs-tabs a[data-toggle="tab"]:first').trigger('click');
});
