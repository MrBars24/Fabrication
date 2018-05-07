$(document).ready(function() {
  var membersTable = null;
  init();
  function init() {
    var params = get_parameters();
    var $form = $('#form-search-all');

    if (params.q != "") {
        $form.find('[name="search_text"]').val(params.q);
    }
  }

  var jobsTable = $('.search-all-jobs-container').initTable({
    url: '/jobs/list',
    limit: 4,
    search:{
        'string': $('#form-search-all [name="search_text"]').val(),
        // 'category': $('#search-all [name=""]').val()
    },
    onBeforeRequest: function() {
      $('.search-all-members-container').html(`
        <div class="text-center">
          <i class="fa fa-spinner fa-spin fa-2x"></i>
        </div>`);
    },
    render: function(data) {
      var container = ``;
      if (data.length > 0) {
        container += `<ul class="list-group list-group-flush">`;
        data.forEach(function(obj, index) {
          container += `
          <li class="list-group-item border-0 mb-0 px-0">
            <h4 class="font-weight-bold text-truncate"><a href="/jobs/${obj.id}">${ obj.title }</a></h4>
            <h5 class="text-truncate text-muted d-block">${ obj.description }</h5>
          </li>`;
        });
        container += `</ul>`;
      }
      else {
        container += `
        <div class="container d-flex justify-content-center align-items-center">
            <div class="d-flex justify-content-center flex-column align-items-center py-4">
                <h3 class="text-muted">No Jobs Found</h3>
            </div>
        </div>
        `;
      }
      return container;
    },
  });




  /* setTimeout(function() {
    membersTable = $('.search-all-members-container').initTable({
      url: '/hire/list',
      limit: 4,
      search:{
          'txtsearch': $('#form-search-all [name="search_text"]').val(),
          // 'category': $('#search-all [name=""]').val()
      },
      onBeforeRequest: function() {
        $('.search-all-members-container').html(`
          <div class="text-center">
            <i class="fa fa-spinner fa-spin fa-2x"></i>
          </div>`);
      },
      render: function(data) {
        var container = ``;
        if (data.length > 0) {
          container += `<ul class="list-group list-group-flush">`;
          data.forEach(function(obj, index) {
            var avatar = print_image(obj.avatar);
            container += `
            <li class="media border-0 px-0">
              <img class="mr-3 rounded-circle" src="${avatar}" alt="Avatar" width="50">
              <div class="media-body">
                <h4 class="mt-0 mb-1"><a href="/members/${obj.id}">${obj.fullname}</a></h4>
                <h5 class="text-dark">${obj.overview}</h5>
                <span class="text-warning mr-2">${ Math.round(obj.average_rating * 100) / 100  }<i class="fa fa-star"></i></span><span>Location here </span>
              </div>
            </li>`;
          });
          container += `</ul>`;
        }
        else {
          container += `
          <div class="container d-flex justify-content-center align-items-center">
              <div class="d-flex justify-content-center flex-column align-items-center py-4">
                  <h3 class="text-muted">No Jobs Found</h3>
              </div>
          </div>
          `;
        }
        return container;
      },
    });
  }, 1000); */

  function runSearch() {
    var  q = $('#form-search-all [name="search_text"]').val();
    // setTimeout(function() {
    jobsTable.search({string: q});
	/* setTimeout(function() {
		membersTable.search({txtsearch: q});
    }, 500); */

    window.history.replaceState("", "Title", "/search/all?" + $.param({q:q}));
  }


  $(document).on('submit', '#form-search-all', function(e) {
    e.preventDefault();
    runSearch();
  });

  // $(document).on('change', '#form-search-all [name="search_text"]', function() {
  //   runSearch();
  // });



});
