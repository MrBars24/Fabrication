$(document).ready(function(){

    var table = $(".pagination-bid-history-container").initTable({
        url: '/jobs/bid-history/list',
        pageContainer: ".pagination-bid-history-bars",
        search:{
            // 'status': $("[name='status']:checked").val(),
            // 'string': $("#search").val(),
            // 'category': $("#category").val(),
            // 'budget': $("#budget").val()
        },
        render: function(data) {
            console.log(data);

            var container = ``;
            if (data != undefined) {
                data.forEach(function(obj, index) {
                    var hired = (obj.accepted_at == null) ? "Open" : "Hired";
                    container += `
                        <li class="list-group-item border-0 py-4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="font-weight-bold mb-1">${obj.title}</h5>
                                        <p class="text-secondary">${obj.description}</p>

                                        <a href="/jobs/${obj.job_id}" class="btn btn-info btn-sm collapsed" >View Job</a> |
                                        <a href="/jobs/${obj.job_id}" class="btn btn-danger btn-sm collapsed">Cancel Bid</a>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb2">
                                                    <small class="text-secondary mb-0">BID DATE</small>
                                                    <h6 class="text-dark font-weight-bold">${obj.created_at}</h6>
                                                </div>
                                                <div class="mb2">
                                                    <small class="text-secondary mb-0">BUDGET</small>
                                                    <h6 class="text-dark font-weight-bold">$${obj.budget_min} - $${obj.budget_max}</h6>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="mb2">
                                                    <small class="text-secondary mb-0">BID STATUS</small>
                                                    <h6 class="text-success font-weight-bold">` + hired +  `</h6>
                                                </div>
                                                <div class="mb2">
                                                    <small class="text-secondary mb-0">BID AMOUNT</small>
                                                    <h6 class="text-dark font-weight-bold">$${ obj.amount }</h6>
                                                </div>

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
                        <h1 class="text-dark ">NO BID HISTORY</h1>
                    </div>
                </div>
                `;
            }
            return container;
        }
    });

});
