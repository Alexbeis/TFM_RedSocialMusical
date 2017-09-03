
var notificationPage = (function () {
        var markAsReadUrl = getBaseUrl() + '/mark-as-read/';

    return {
        markAsRead: function (id) {
            var newurl = markAsReadUrl + id;
            this.markAsRequest('GET', newurl, null, this.updateCount);
        },
        markAsRequest: function (method, url, data, callback) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.updateCount) {
                        callback(response.not_id);
                    }
                }
            };
            xhr.open(method, url, false);
            xhr.send();
        },
        updateCount: function (id) {
            var count = parseInt($('#countNotifications').text()),
                countElement = $('#countNotifications');
            if (count == 0) return;
            else {
                countElement.text(count - 1);
                document.getElementById('noti_'+id).remove();
            }

            if(parseInt(countElement.text()) == 0) {
                countElement.addClass('hidden');
            } else {
                countElement.removeClass('hidden');
            }
        }
    }
}());





