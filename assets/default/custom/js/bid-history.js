$(document).ready(function(){
    var table = $(".bid-history-container").initTable({
        url: '/jobs/bid-history/list',
        pageContainer: ".bid-history-pagination",
        search:{
            // 'status': $("[name='status']:checked").val(),
            // 'string': $("#search").val(),
            // 'category': $("#category").val(),
            // 'budget': $("#budget").val()
        },
        render: function(data) {
            var container = ``;
            if (data.length > 0) {
                data.forEach(function(obj, index) {
                    var hired = (obj.accepted_at == null) ? "Active" : "Hired";
					var dt = format_date(obj.created_at);
                    container += `<ul class="list-group list-group-flush">`;
                    container += `
                        <li class="list-group-item py-4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="font-weight-bold mb-1">${obj.title}</h5>
                                        <p class="text-secondary">${obj.description}</p>
                                        <a href="/jobs/${obj.job_id}" class="btn btn-info btn-sm collapsed" >View Job</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb2">
                                                    <small class="text-secondary mb-0">BID DATE</small>
                                                    <h6 class="text-dark font-weight-bold">${dt}</h6>
                                                </div>
                                                <div class="mb2">
                                                    <small class="text-secondary mb-0">BUDGET</small>
                                                    <h6 class="text-dark font-weight-bold">$${obj.budget_min} - $${obj.budget_max}</h6>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="mb2">
                                                    <small class="text-secondary mb-0">BID STATUS</small>
                                                    <h6 class="text-dark font-weight-bold">` + hired +  `</h6>
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
                    container += `</ul>`;
                });
            } else {
                container += `
                <div class="container d-flex justify-content-center align-items-center">
                    <div class="d-flex justify-content-center flex-column align-items-center py-4">
                        <h3 class="text-muted">You haven't bid to any job yet</h3>
                    </div>
                </div>
                `;
            }
            return container;
        }
    });

});
