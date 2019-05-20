var role = $("#role").val();

var notificationsWrapper   = $('#dropdown-notifications');
var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
var notificationsCountElem = notificationsWrapper.find('.notificationcount');
var notificationsCount     = parseInt(notificationsCountElem.text());
var notifications          = notificationsWrapper.find('.app-notification__content');

// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

var pusher = new Pusher('045a22922e43877beb51', {
    encrypted: true,
    cluster: 'ap1',
    forceTLS: true
});

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('assign-file');
if(role == "4"){
    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\AssignFile', function(data) {
        var existingNotifications = notifications.html();
        var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
        var newNotificationHtml = `
            <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-arrow-circle-left fa-stack-1x fa-inverse"></i></span></span>
            <div>
                <p class="app-notification__message">`+data.message+`</p>
            </div></a></li>
        `;
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.text(notificationsCount);
        // notificationsWrapper.find('.notif-count').text(notificationsCount);
        // notificationsWrapper.show();
    });
}

var channel1 = pusher.subscribe('failed-login');
if(role != "4"){
    // Bind a function to a Event (the full Laravel class)
    channel1.bind('App\\Events\\FailedLogin', function(data) {
        var existingNotifications1 = notifications.html();
        var newNotificationHtml1 = `
            <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-sign-in fa-stack-1x fa-inverse"></i></span></span>
            <div>
                <p class="app-notification__message">`+data.message+`</p>
            </div></a></li>
        `;
        notifications.html(newNotificationHtml1 + existingNotifications1);

        notificationsCount += 1;
        notificationsCountElem.text(notificationsCount);
        // notificationsWrapper.find('.notif-count').text(notificationsCount);
        // notificationsWrapper.show();
    });

    // User Print Event;
    var channel2 = pusher.subscribe('print-file');

    // Bind a function to a Event (the full Laravel class)
    channel2.bind('App\\Events\\PrintFile', function(data) {
        var existingNotifications2 = notifications.html();
        var newNotificationHtml2 = `
            <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-print fa-stack-1x fa-inverse"></i></span></span>
            <div>
                <p class="app-notification__message">`+data.message+`</p>
            </div></a></li>
        `;
        notifications.html(newNotificationHtml2 + existingNotifications2);

        notificationsCount += 1;
        notificationsCountElem.text(notificationsCount);
        // notificationsWrapper.find('.notif-count').text(notificationsCount);
        // notificationsWrapper.show();
    });
}
 