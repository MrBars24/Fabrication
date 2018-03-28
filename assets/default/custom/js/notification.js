$(document).ready(function() {

    notificationDropdown();

    function notificationDropdown() {
        $notificationDropdown = $('#dropdown-notification');

        $notificationDropdown.on('show.bs.dropdown', function () {
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
        <li class="list-group-item py-1 px-3" data-id="${ item.id }">
            <div>
                ${item.template}
            </div>
            <small class="text-muted">${moment(item.created_at).fromNow()}</small>
        </li>`;
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