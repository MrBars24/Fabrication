$(document).ready(function() {
  var table = $('#jobs-previous').initTable({
      url: '/jobs/previous-project/list',
      pageContainer: "#jobs-previous-pagination",
      render: function(data) {
        var container = ``;
        if (data.length > 0) {
          container += `<ul class="list-group list-group-flush">`;
          data.forEach(function(obj, index) {
            container += `
            <li class="list-group-item">
              <div class="row">
                <div class="col-sm-6">
                  <h4 class="font-weight-bold text-truncate mb-2"><a href="/jobs/${obj.id}">${ obj.title }</a></h4>
                  <h5 class="mb-3">${obj.fullname}</h5>
                  <h5 class="text-truncate text-muted d-block">${ moment(obj.bid_info.accepted_at).format("MMMM D, YYYY")  } - ${ moment(obj.finished_at).format("MMMM D, YYYY") }</h5>
                </div>
                <div class="col-sm-6">
                  <small>Amount</small>
                  <h6 class="font-weight-bold">$ ${obj.bid_info.amount}</h6>
                  <small>Category</small>
                  <h6 class="font-weight-bold">${obj.project_category}</h6>
                </div>
              </div>
            </li>`;
          });
          container += `</ul>`;
        }
        else {
          container += `
            <div class="container d-flex justify-content-center align-items-center" style="height: 100px;">
                <div class="row h-100 d-flex justify-content-center align-items-center">
                    <h3 class="text-muted">You don't have any previous Jobs yet</h3>
                </div>
            </div>
          `;
        }

        return container;
      },
    });
});
