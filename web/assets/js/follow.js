var followAjax = (function () {
    var followUrl   = window.location.href + '../../follow-user/';
    var unfollowUrl = window.location.href + '../../unfollow-user/';

    return {
        followRequest: function (e) {
            e.classList.toggle("hidden");
            for (var i =0; i < e.parentNode.childNodes.length; i++) {
                if(e.parentNode.childNodes[i].classList != undefined && e.parentNode.childNodes[i].classList.contains('btn-unfollow')) {
                    e.parentNode.childNodes[i].classList.remove('hidden');
                }
            }
            var id = e.getAttribute('data-follow'),
                url = followUrl + parseInt(id),
                xhr = new XMLHttpRequest();
            xhr.open("GET", url, false);
            xhr.send();

            console.log(xhr.responseText);
        },
        unfollowRequest: function(e) {
            e.classList.toggle("hidden");
            for (var i =0; i < e.parentNode.childNodes.length; i++) {
                if (e.parentNode.childNodes[i].classList != undefined && e.parentNode.childNodes[i].classList.contains('btn-follow')) {
                    e.parentNode.childNodes[i].classList.remove('hidden');
                }
            }
            var id = e.getAttribute('data-follow'),
                url = unfollowUrl + parseInt(id),
                xhr = new XMLHttpRequest();
            xhr.open("GET", url, false);
            xhr.send();

            console.log(xhr.responseText);
        }
    }
}());

