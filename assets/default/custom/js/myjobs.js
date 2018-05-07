$(document).ready(function(){
	var search = null;
	if(get_segment(3)=='active'){
		search = {
			status : 'open'
		};
	}
    var table = $(".my-posted-job").initTable({
        url: '/jobs/posted/list',
        pageContainer: ".pagination-myjobs-bars",
		search:search,
        render:function(data){
        var container = ``;
        if(data.length > 0){
        data.forEach(function(obj,index){
			var ago = compute_ago(obj.created_at);
            var avatar = (obj.avatar == null) ? "../assets/images/icon_profile.jpg" : obj.avatar;
            container += `<div class="sl-item">
                <div class="sl-left">
                    <img src="`+ avatar +`" alt="" class="img-circle">
                </div>
                <div class="sl-right">
                    <big><a href="/jobs/posted/manage/${obj.id}" class="text-primary">${obj.title}</a></big>
                    <br>

                    <span class="sl-date">
                        ${ago}
                    </span>

                    <p>
                        ${obj.description}
                    </p>
                    <div class="like-comm">
                        <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-gavel text-danger"></i> ${obj.bids} Bids</a>
                        <a href="/jobs/posted/manage/${obj.id}" class="text-dark m-r-10" data-toggle="tooltip" title="Manage Job"><i class="mdi mdi-settings"></i> Manage</a>
                        <a href="/jobs/${obj.id}" class="text-dark" data-toggle="tooltip" title="View Job"><i class="mdi mdi-eye-outline"></i> View Job</a>
                    </div>
                </div>
            </div>`;
                });
            }
            else{
                container += `
                <div class="container d-flex justify-content-center align-items-center">
                    <div class="d-flex justify-content-center flex-column align-items-center py-4">
                        <h3 class="text-muted">You haven't posted any job yet</h3>
                        <p class="text-muted">Start Bidding to Win Jobs</p>
                        <a href="/jobs/create" class="btn btn-success btn-lg">Post a Job</a>
                    </div>
                </div>
                `;
            }
            return container;
        }
        });

});
