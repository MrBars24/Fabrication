toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

function get_segment(i) {
    var a = window.location.href.split("/");
    a.shift();
    a.shift();
    a.shift();
    return a[i - 1];
}

function get_parameters() {
	var query = window.location.search.substring(1);
    var vars = query.split("&");
    var query_string = {};
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        // If first entry with this name
        if (typeof query_string[pair[0]] === "undefined") {
            query_string[pair[0]] = decodeURIComponent(pair[1]);
            // If second entry with this name
        } else if (typeof query_string[pair[0]] === "string") {
            var arr = [query_string[pair[0]], decodeURIComponent(pair[1])];
            query_string[pair[0]] = arr;
            // If third or later entry with this name
        } else {
            query_string[pair[0]].push(decodeURIComponent(pair[1]));
        }
    }
    return query_string;
}

function auth() {
  return localStorage.getItem('auth_user');
}

function countLines(elem) {
	var divHeight = elem.outerHeight();
	var lineHeight = parseInt(elem.css('line-height'));
	var lines = divHeight / lineHeight;
	console.log("Lines: " + lines);
}

function print_image(image){
	if(image == "" || image == null || image == 0){
        return '/assets/images/icon_profile.jpg';
	}
    return image;
}

function call_loader(){
	return `
	<div class="loader-container">
	<svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
	</svg>
	</div>`;
}

function compute_ago(created){
	var a = $("meta[name=current]").attr("content");
	var ago = "just now";
	//console.log(a,created);
	/* if( moment(a).diff(created, 'seconds') > 0 ){
		ago = moment(a).diff(created, 'seconds') + " seconds ago";
	} */

	if( moment(a).diff(created, 'minutes') > 0 ){
		ago = moment(a).diff(created, 'minutes') + " minutes ago";
	}

	if( moment(a).diff(created, 'hours') > 0 ){
		ago = moment(a).diff(created, 'hours') + " hours ago";
	}

	if( moment(a).diff(created, 'days') > 0 ){
		ago = moment(a).diff(created, 'days') + " days ago";
	}

	if( moment(a).diff(created, 'months') > 0 ){
		ago = moment(a).diff(created, 'months') + " months ago";
	}

	if( moment(a).diff(created, 'years') > 0 ){
		ago = moment(a).diff(created, 'years') + " years ago";
	}
	//console.log(moment(a).diff(created, 'minutes'));
	return ago;
}

function format_date(created,frmt = 'MMMM DD, YYYY'){
	return moment(created).format(frmt);
}

$(document).ready(function(){
	  // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

});
