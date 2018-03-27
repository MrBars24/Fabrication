$(document).ready(function() {

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
                    fb_auth(res,'login');
                }, { 'fields': 'email,name,picture,first_name,last_name,link' });
            } else {
                FB.login(function(response) {
                    if (response.authResponse) {
                        FB.api('/me', function(response) {
                            fb_auth(response,'login');
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
                    fb_auth(res,'signup');
                }, { 'fields': 'email,name,picture,first_name,last_name,link' });
            } else {
                FB.login(function(response) {
                    if (response.authResponse) {
                        FB.api('/me', function(response) {
                            fb_auth(response,'signup');
                        });
                    } else {
                        alert('login cancelled');
                    }
                }, { 'fields': 'email,name,picture,first_name,last_name,link' });
            }
        });
    });

    function fb_auth(res,type) {
        $.ajax({
            type: 'post',
            url: '/facebook/' + type,
            data: res,
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    if(type == 'signup' ){
                        location.href = "/settings";
                    }else{
                        window.location.href = result.data.url_redirect;
                    }
                }
            },
            error: function(requestObject, error, errorThrown) {
                //console.log(requestObject);
                if (requestObject.status == 401) {
                    $.each(requestObject.responseJSON.error, function(index, error) {
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
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function(result) {
                if (result.success == 200) {
                    window.location.href = result.data.url_redirect;
                }
            },
            error: function(requestObject, error, errorThrown) {
                //console.log(requestObject);
                if (requestObject.status == 401) {
                    $.each(requestObject.responseJSON.error, function(index, error) {
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

    });
});