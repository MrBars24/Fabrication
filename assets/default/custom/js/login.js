$(document).ready(function() {
    startApp();

    $('#login').on('shown.bs.modal', function() {
        $("#username-focus").focus();
    });
    $('#signupModal').on('shown.bs.modal', function() {
        $("#firstname-focus").focus();
    });

    $(document).on('click', '.btn-facebook-login', function() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api('/me', function(res) {
                    fb_auth(res, 'login');
                }, { 'fields': 'email,name,picture,first_name,last_name,link' });
            } else {
                FB.login(function(response) {
                    if (response.authResponse) {
                        FB.api('/me', function(response) {
                            fb_auth(response, 'login');
                        });
                    } else {
                        alert('login cancelled');
                    }
                }, { 'fields': 'email,name,picture,first_name,last_name,link' });
            }
        });
    });

    $(document).on('click', '.btn-facebook-signup', function() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api('/me', function(res) {
                    fb_auth(res, 'signup');
                }, { 'fields': 'email,name,picture,first_name,last_name,link' });
            } else {
                FB.login(function(response) {
                    if (response.authResponse) {
                        FB.api('/me', function(response) {
                            fb_auth(response, 'signup');
                        });
                    } else {
                        alert('login cancelled');
                    }
                }, { 'fields': 'email,name,picture,first_name,last_name,link' });
            }
        });
    });

    function fb_auth(res, type) {
        $.ajax({
            type: 'post',
            url: '/facebook/' + type,
            data: res,
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    if (type == 'signup') {
                        location.href = "/settings";
                    } else {
                        window.location.href = result.data.url_redirect;
                    }
                }
            },
            error: function(requestObject, error, errorThrown) {
                //console.log(requestObject);
                if (requestObject.status == 401) {
                    var req = JSON.parse(requestObject.responseText);
                    $.each(req.responseJSON.error, function(index, error) {
                        if (error.name == "username") {
                            var target = $("#form-login input[name=" + error.name + "]").data('target-error-text');
                            $(target).parent().parent().removeAttr('hidden');
                            $(target).parent().parent().parent().parent().addClass('error');
                            $(target).html(error.message);
                        } else if (error.name == "pwd") {
                            var target = $("#form-login  input[name=" + error.name + "]").data('target-error-text');
                            $(target).parent().parent().removeAttr('hidden');
                            $(target).parent().parent().parent().parent().addClass('error');
                            $(target).html(error.message);
                            $('#username-error').parent().parent().parent().parent().removeClass('error');
                            $('#username-error').parent().parent().attr('hidden', '');
                        } else {}
                    });
                }
            }
        });
    }

    $(document).on("submit", "#form-login", function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serializeArray();
        var $form = $(this);

        var $alert = $form.find('.alert-login-message');
        $alert.html('');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function(result) {
                if (result.success == 200) {
                  // Put the logged user info on local storage
                  localStorage.setItem('auth_user', JSON.stringify(result.data.user_details));
                  window.location.href = result.data.url_redirect;
                }
            },
            error: function(requestObject, error, errorThrown) {
                if (requestObject.status == 401) {
                    var req = JSON.parse(requestObject.responseText);
                    $.each(req.error, function(index, error) {
                        if (error.name == "username") {
                            var target = $("#form-login input[name=" + error.name + "]").data('target-error-text');
                            $(target).parent().parent().removeAttr('hidden');
                            $(target).parent().parent().parent().parent().addClass('error');
                            $(target).html(error.message);
                        } else if (error.name == "pwd") {
                            var target = $("#form-login  input[name=" + error.name + "]").data('target-error-text');
                            $(target).parent().parent().removeAttr('hidden');
                            $(target).parent().parent().parent().parent().addClass('error');
                            $(target).html(error.message);
                            $('#username-error').parent().parent().parent().parent().removeClass('error');
                            $('#username-error').parent().parent().attr('hidden', '');
                        } else if(error.name == "activate"){
                            $alert.html(`
                                <div class="col-10 offset-1">
                                <div class="alert alert-danger fade in alert-dismissible show">
                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" style="font-size:20px">×</span>
                                  </button>
                                  <h4>Oops!</h4>
                                  <p>You need to verify your account first!</p>
                                </div>
                            </div>`);
                        }
                        else {}
                    });
                }
            }
        });

    });
});


var googleUser = {};
var startApp = function() {
    gapi.load('auth2', function() {
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
            client_id: '985848939646-54lbt7vtmbv05qlj28vgdprifsdcp61i.apps.googleusercontent.com',
            cookiepolicy: 'single_host_origin',
            // Request scopes in addition to 'profile' and 'email'
            //scope: 'additional_scope'
        });

		if(document.querySelectorAll('.btn-googleplus').length > 0){
			attachSignin(document.querySelectorAll('.btn-googleplus'));
		}
    });
};

function attachSignin(element) {
    //console.log(element);
	if(element.length > 0){
		for (e in element) {
			auth2.attachClickHandler(element[e], {},
				onSignIn,
				onSignCancel);
		}
	}
}

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();

    var data = {
        "id" : profile.getId(),
        "firstname" : profile.getGivenName(),
        "lastname" : profile.getFamilyName(),
        "img" : profile.getImageUrl(),
        "email" : profile.getEmail(),
        "fullname" : profile.getName()
    };

    google_auth(data);
    //console.log(profile.getGivenName());
    /*console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.*/
}

function onSignCancel(err) {
    alert(JSON.stringify(err, undefined, 2));
}

function google_auth(res) {
    $.ajax({
        type: 'post',
        url: '/google/auth',
        data: res,
        dataType: 'json',
        success: function(result) {
            if (result.success) {
                if (result.type == 'signup') {
                    location.href = "/settings";
                } else {
                    window.location.href = result.data.url_redirect;
                }
            }
        },
        error: function(requestObject, error, errorThrown) {
            //console.log(requestObject);
            if (requestObject.status == 401) {
                var req = JSON.parse(requestObject.responseText);
                $.each(req.responseJSON.error, function(index, error) {
                    if (error.name == "username") {
                        var target = $("#form-login input[name=" + error.name + "]").data('target-error-text');
                        $(target).parent().parent().removeAttr('hidden');
                        $(target).parent().parent().parent().parent().addClass('error');
                        $(target).html(error.message);
                    } else if (error.name == "pwd") {
                        var target = $("#form-login  input[name=" + error.name + "]").data('target-error-text');
                        $(target).parent().parent().removeAttr('hidden');
                        $(target).parent().parent().parent().parent().addClass('error');
                        $(target).html(error.message);
                        $('#username-error').parent().parent().parent().parent().removeClass('error');
                        $('#username-error').parent().parent().attr('hidden', '');
                    } else {}
                });
            }
        }
    });
}
