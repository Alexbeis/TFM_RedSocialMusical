var PublicationAjax = (function () {

    var removeUrl   = getBaseUrl() + '/delete-publication/',
        likeUrl     = getBaseUrl() + '/like/',
        dislikeUrl  = getBaseUrl() + '/dislike/';

    return {
        remove: function (e) {
            var id =  e.getAttribute('data-id'),
                url = removeUrl + parseInt(id),
                xhr = new XMLHttpRequest();
            console.log(url);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    location.reload();
                }
            }
            xhr.open("GET", url, false);
            xhr.send();
        },
        like: function(e) {
            var id =  e.getAttribute('data-id'),
                url = likeUrl + parseInt(id);
            e.classList.toggle('hidden');

            for (var i =0; i < e.parentNode.childNodes.length; i++) {
                if(e.parentNode.childNodes[i].classList != undefined && e.parentNode.childNodes[i].classList.contains('btn-dislike')) {
                    e.parentNode.childNodes[i].classList.remove('hidden');
                }
            }
            this.Request("GET", url);
        },

        dislike: function(e) {

            var id =  e.getAttribute('data-id'),
                url = dislikeUrl + parseInt(id);

            e.classList.toggle('hidden');

            for (var i =0; i < e.parentNode.childNodes.length; i++) {
                if(e.parentNode.childNodes[i].classList != undefined && e.parentNode.childNodes[i].classList.contains('btn-like')) {
                    e.parentNode.childNodes[i].classList.remove('hidden');
                }
            }
            this.Request("GET", url);
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

