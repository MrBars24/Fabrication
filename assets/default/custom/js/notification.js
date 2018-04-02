$(document).ready(function() {

    notificationDropdown();
    var loaded = false;

    function notificationDropdown() {
        $notificationDropdown = $('#dropdown-notification');

        $notificationDropdown.on('show.bs.dropdown', function () {
            if (loaded) {
                return;
            }
            getNotifications(function(response) {
                if (response.success) {
                    var notificationHtml = '';
                    $.each(response.data.notifications, function(index, notification) {
                        notificationHtml += formatNotificationItem(notification);
                    });
                    $notificationDropdown.find('.notification-list').html(notificationHtml);
                } 
            });
        });
    }


    $(document).on('click', '.notification-item .btn-read', read);
    $(document).on('click', '.notification-item .btn-hide', hide);
    $(document).on('click', '.notification-item .btn-unread', unread);
    $(document).on('click', '.notification-list .btn-read-all', readAll);

    function getNotifications(callback) {
        $.ajax({
            url: '/api/v1/notifications',
            method: 'GET',
            success: function(response) {
                callback(response);
            }
        });
    }
    function formatNotificationItem(item) {
        return `
        <li class="list-group-item py-1 pr-4 pl-3 notification-item ${ item.read_at == null ? 'new' : '' }" data-id="${ item.id }">
            <div class="notification-status-action">
                <button class="btn btn-link ${ item.read_at == null ? 'btn-read' : 'btn-unread' }" title="${ item.read_at == null ? 'Mark as Read' : 'Mark as Unread' }"><i class="fa ${ item.read_at == null ? 'fa-check' : 'fa-times' }"></i></button>
                <button class="btn btn-link ${ item.hidden_at == null ? 'btn-hide' : '' }" title="Hide">hide</button>
            </div>
            <div>
                ${ item.content }
            </div>
            <small class="text-muted">${ moment(item.created_at).fromNow() }</small>
        </li>`;
    }

    function read(e) {
        e.preventDefault();
        var $button = $(this);
        var id = $button.parents('.notification-item').data('id');

        var data = {
            'id': id,
            'status': 'read'
        };

        update(data, function(response) {
            $button.removeClass('btn-read');
            $button.addClass('btn-unread');
            $button.prop('title', 'Mark as Unread');
            $button.parents('.notification-item').removeClass('new');
        });
    }
    
    function unread(e) {
        e.preventDefault();
        var $button = $(this);
        var id = $button.parents('.notification-item').data('id');

        var data = {
            'id': id,
            'status': 'unread'
        };

        update(data, function(response) {
            $button.addClass('btn-read');
            $button.removeClass('btn-unread');
            $button.prop('title', 'Mark as Read');
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
            // $button.parents('.notification-item').removeClass('new');
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