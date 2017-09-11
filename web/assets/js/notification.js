var Notification = (function () {
   var userId = document.getElementById('countNotifications').getAttribute('data-user'),
    countNotificationsUrl = getBaseUrl() + '/notifications/count/'+ userId;

   return {
       getCount: function () {
            this.notificationRequest('GET', countNotificationsUrl, null, this.addToCounter);
       },
       notificationRequest: function (method, url, data, callback) {
           var xhr = new XMLHttpRequest();
           xhr.onreadystatechange = function () {
               if (xhr.readyState == 4 && xhr.status == 200) {
                   var response = JSON.parse(xhr.responseText);
                   callback(response.nCount);
               }
           };
           xhr.open(method, url, false);
           xhr.send();
       },
       addToCounter: function(count) {
           $('#countNotifications').html(count);
       }
   }
}());

