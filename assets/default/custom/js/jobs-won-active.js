$(document).ready(function() {
  var table = $('#jobs-won-active').initTable({
      url: '/jobs/my-jobs/list',
      pageContainer: "#jobs-won-active-pagination",
      render: function(data) {
        var container = ``;
        if (data.length > 0) {
          container += `<ul class="list-group list-group-flush">`;
          data.forEach(function(obj, index) {
            container += `
            <li class="list-group-item">
              <div class="row">
                <div class="col-sm-6">
                  <h4 class="font-weight-bold text-truncate"><a href="/jobs/${obj.id}">${ obj.title }</a></h4>
                  <small class="text-truncate text-muted d-block">${ obj.description }</small>
                </div>
                <div class="col-sm-6"></div>
              </div>
            </li>`;
          });
          container += `</ul>`;
        }
        else {
          container += `
          <div class="container d-flex justify-content-center align-items-center">
              <div class="d-flex justify-content-center flex-column align-items-center py-4">
                  <h3 class="text-muted">You don't have any previous Jobs yet</h3>
                  <p class="text-muted">Start Bidding to Win Jobs</p>
                  <a href="/work" class="btn btn-success btn-lg">Find Jobs</a>
              </div>
          </div>
          `;
        }

        return container;
      },
    });
});
