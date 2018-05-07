$(document).ready(function() {

    notificationDropdown();
    notificationListener();
    var loaded = false;

    function notificationDropdown() {
        $notificationDropdown = $('#dropdown-notification');

        $notificationDropdown.on('show.bs.dropdown', function () {
            if (loaded) {
                return;
            }
            getNotifications(function(response) {
                if (response.success) {
                    loaded = true;
                    var notificationHtml = '';
                    $.each(response.data.notifications, function(index, notification) {
                        notificationHtml += formatNotificationItem(notification);
                    });
                    $notificationDropdown.find('.notification-list .scrollable-wrapper').html(notificationHtml);
                }
            });
        });

        $('.notification-list').scrollify({
          triggered: function() {
            // load more here
          }
        });
    }

    function notificationListener() {
      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('ba4265c88567e3fcd1cd', {
    		cluster: 'ap1',
    		encrypted: true
      });
      var member_id = JSON.parse(auth()).id;
      var channel = pusher.subscribe('member_' + member_id);

      channel.bind('new_notification', newNotificationReceived);
    }

    function newNotificationReceived(data) {
      $notificationDropdown = $('#dropdown-notification');
      $notificationDropdown.find('.notification-list .scrollable-wrapper').prepend(formatNotificationFromSocket(data));
      toggleNewIndicator(true);
    }

    $(document).on('click', '.notification-item .btn-read', read);
    $(document).on('click', '.notification-item .btn-hide', hide);
    $(document).on('click', '.notification-item .btn-unread', unread);
    $(document).on('click', '.btn-read-all-notifications', readAll);

    function getNotifications(callback) {
        $.ajax({
            url: '/api/v1/notifications',
            method: 'GET',
            success: function(response) {
                callback(response);
            }
        });
    }

    function formatNotificationFromSocket(data) {
      var notification = data.message;
      return formatNotificationItem(notification);
    }

    function formatNotificationItem(item) {
		var ago = compute_ago(item.created_at);
        return `
        <li class="list-group-item py-1 pr-4 pl-3 notification-item ${ item.read_at == null ? 'new' : '' }" data-id="${ item.id }">
            <div class="notification-status-action">
                <button class="btn btn-link ${ item.read_at == null ? 'btn-read' : 'btn-unread' }" title="${ item.read_at == null ? 'Mark as Read' : 'Mark as Unread' }"><i class="fa ${ item.read_at == null ? 'fa-check' : 'fa-times' }"></i></button>
                <button class="btn btn-link ${ item.hidden_at == null ? 'btn-hide' : '' }" title="Hide">hide</button>
            </div>
            <div>
                ${ item.content }
            </div>
            <small class="text-muted">${ ago }</small>
        </li>`;
    }

    function read(e,elem=null) {
        if(e!=null){
            e.preventDefault();
        }

        var $button;
        if(elem != null){
            $button = elem;
        }else{
            $button =  $(this);
        }

        var id = $button.parents('.notification-item').attr('data-id');

        console.log($button);

        var data = {
            'id': id,
            'status': 'read'
        };

        update(data, function(response) {
            $button.removeClass('btn-read')
                .addClass('btn-unread')
                .prop('title', 'Mark as Unread');

            $button.find('i').removeClass('fa-check').addClass('fa-times');
            $button.parents('.notification-item').removeClass('new');

            if(response.data.unread_notifications == 0) {
                toggleNewIndicator(false);
            }
        });
    }

    $(document).on("click",".notification-item.new>div>a",function(e){
        read(null,$(this));
    });

    function unread(e) {
        e.preventDefault();
        var $button = $(this);
        var id = $button.parents('.notification-item').data('id');

        var data = {
            'id': id,
            'status': 'unread'
        };

        update(data, function(response) {
          $button.addClass('btn-read')
            .removeClass('btn-unread')
            .prop('title', 'Mark as Read');

          $button.find('i').removeClass('fa-times').addClass('fa-check');
          $button.parents('.notification-item').addClass('new');
        });
    }

    function hide(e) {
        e.preventDefault();
        var $button = $(this);
        var id = $button.parents('.notification-item').data('id');

        var data = {
            'id': id,
            'status': 'hide'
        };

        update(data, function(response) {
            $button.removeClass('btn-hide');
            $button.addClass('btn-unhide');
            $button.prop('title', 'Unhide');
            $button.parents('li.notification-item').remove();
            // $button.parents('.notification-item').removeClass('new');
        });
    }
    function readAll(e) {
        e.preventDefault();

        var data = {
            'status': 'read_all'
        };

        // Remove blinking icon instanlty
        toggleNewIndicator(false);

        // Send the ajax request
        $.ajax({
            url: '/api/v1/notifications/all/read',
            type: 'POST',
            success: function(response) {
                if (response.success) {

                  $('.notification-item.new').each(function(index, item) {
                    var $button = $(item).find('.btn-read');
                    $button.removeClass('btn-read')
                      .addClass('btn-unread')
                      .prop('title', 'Mark as Unread');

                    $button.find('i').removeClass('fa-check').addClass('fa-times');
                    $button.parents('.notification-item').removeClass('new');
                  });
                  // $('.notification-item.new').removeClass('new');
                }
            },
            error: function() {
              toastr.error('Error','Something went wrong')
            }
        });
    }

    function update(data, callback) {
        $.ajax({
            url: '/api/v1/notifications/' + data.id,
            type: 'POST',
            data: data,
            success: function(response) {
                callback(response);
            },
            error: function() {

            }
        });
    }

    function toggleNewIndicator(option = true) {
      if (option) {
        $('#dropdown-notification .notify').removeClass('d-none');
        return;
      }
      $('#dropdown-notification .notify').addClass('d-none');
    }

    // If the page is Notification
    if (!$('body').hasClass('page-notification')) {
        return;
    }

    notificationPageData();

    function notificationPageData() {
        var table = $('.notifications-page-notifications').initTable({
            url: '/api/v1/notifications',
            pageContainer: ".notifications-page-notifications-pagination",
            limit: 5,
            render: function(data) {
                var container = ``;
                if (data.length > 0) {
                    data.forEach(function(obj, index) {
                        container += `
                            1
                        `;
                    });
                } else {
                    container = `
                    <div class="container d-flex justify-content-center align-items-center" style="height: 100px;">
                        <div class="row h-100 d-flex justify-content-center align-items-center">
                            <h4 class="text-dark ">No Result</h4>
                        </div>
                    </div>
                    `;
                }
                return container;
            }
        });
    }
});
