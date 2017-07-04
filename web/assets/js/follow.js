var followAjax = (function () {
    var followUrl   = getBaseUrl() + '/follow-user/',
        unfollowUrl = getBaseUrl() + '/unfollow-user/',
        method      = "GET";

    return {
        followRequest: function (e) {
            e.classList.toggle("hidden");
            for (var i =0; i < e.parentNode.childNodes.length; i++) {
                if(e.parentNode.childNodes[i].classList != undefined && e.parentNode.childNodes[i].classList.contains('btn-unfollow')) {
                    e.parentNode.childNodes[i].classList.remove('hidden');
                }
            }
            var id = e.getAttribute('data-follow'),
                url = followUrl + parseInt(id);
            this.Request(method, url);
        },
        unfollowRequest: function(e) {
            e.classList.toggle("hidden");
            for (var i =0; i < e.parentNode.childNodes.length; i++) {
                if (e.parentNode.childNodes[i].classList != undefined && e.parentNode.childNodes[i].classList.contains('btn-follow')) {
                    e.parentNode.childNodes[i].classList.remove('hidden');
                }
            }
            var id = e.getAttribute('data-follow'),
                url = unfollowUrl + parseInt(id);
            this.Request(method, url);
        },
        Request: function (method, url) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.open(method, url, false);
            xhr.send();
        }
    }
}());

