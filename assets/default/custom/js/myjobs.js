$(document).ready(function(){

    var table = $(".my-posted-job").initTable({
        url: '/jobs/my-jobs/list',
        pageContainer: ".pagination-myjobs-bars",
        render:function(data){
        var container = ``;
        if(data != undefined){
        console.log(data);
        data.forEach(function(obj,index){
            container += `<div class="sl-item">
                <div class="sl-left">
                    <img src="${obj.avatar}" alt="" class="img-circle">
                </div>
                <div class="sl-right">
                    <big><a href="/jobs/posted/manage/${obj.id}" class="text-primary">${obj.title}</a></big>
                    <br>

                    <span class="sl-date">
                        ${obj.created_at}
                    </span>

                    <p>
                        ${obj.description}
                    </p>
                    <div class="like-comm">
                        <a href="javascript:void(0)" class="link m-r-10"><i class="fa fa-gavel text-danger"></i> ${obj.bids} Bids</a>
                        <a href="/jobs/posted/manage/${obj.id}" class="text-dark m-r-10" data-toggle="tooltip" title="Manage Job"><i class="mdi mdi-settings"></i> Manage</a>
                        <a href="/jobs" class="text-dark" data-toggle="tooltip" title="View Job"><i class="mdi mdi-eye-outline"></i> View Job</a>
                    </div>
                </div>
            </div>`;
                });
            }
            else{
                container += `
                <div class="container d-flex justify-content-center align-items-center" style="height: 100px;">
                    <div class="row h-100 d-flex justify-content-center align-items-center">
                        <h1 class="text-dark ">NO POST</h1>
                    </div>
                </div>
                `;
            }
            return container;
        }
        });

});
