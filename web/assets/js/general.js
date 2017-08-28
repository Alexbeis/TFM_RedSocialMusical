$(document).ready(function () {
    // console.log(getBaseUrl());
    // if (getBaseUrl() == 'http://melomaniacs.com/app_dev.php') {
    //     return;
    // } else {
        var countNotifications = $('#countNotifications');
        if(countNotifications.text() == 0) {
            countNotifications.addClass('hidden');
        } else {
            countNotifications.removeClass('hidden');
        }
        notifications();
        setInterval(notifications, 60000);
    // }

    //Spotify player responsive:

    $('.spoti-iframe').each( function() {
        $(this).css('width',$(this).parent(1).css('width') );
        $(this).attr('src',$(this).attr('src'));
    });

    $(window).resize(function() {
        $('.spoti-iframe').each( function() {
            $(this).css('width',$(this).parent(1).css('width') );
            $(this).attr('src',$(this).attr('src'));
        });
    });


});

function getBaseUrl() {

    if (window.location.pathname.split('/')[1].indexOf('.php') > -1) {
        var baseUrl = window.location.protocol + '//' + window.location.hostname + '/' + window.location.pathname.split('/')[1];
    } else {
        var baseUrl = window.location.protocol + '//' + window.location.hostname;
    }
    return baseUrl;
};

function notifications() {
    var countNotifications = $('#countNotifications');
    Notification.getCount();

    if(countNotifications.text() == 0) {
        countNotifications.addClass('hidden');
    } else {
        countNotifications.removeClass('hidden');
    }

}