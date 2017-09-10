var SpotifyRequest = (function () {

    var searchUrl = getBaseUrl() + '/spotify/search',
        createUrl = getBaseUrl() + '/create-publication-spotify/new',
        method    = 'POST';

    return {
        search: function (e) {
             var song = document.getElementById('song').value;
             if (song == '') return;
             var data = {song :song};
             this.spotifyRequest(method , searchUrl, data, this.add);
        },

        share: function(e) {

            var spotiContent = document.getElementById('spoti-content');

            for (var i = 0; i <  spotiContent.childNodes.length; i++) {
                for (var j = 0; j < spotiContent.childNodes[i].childNodes.length; j++) {
                    if (spotiContent.childNodes[i].childNodes[j].tagName == 'INPUT') {
                        var uri = spotiContent.childNodes[i].childNodes[j].getAttribute('data-uri');
                    }
                }
            }
            if (uri == 0) {
                return;
            }
            var data = {uri: uri};
            this.createPublicationRequest(method, createUrl, data, this.reload);
        },

        spotifyRequest: function(method, url , data, callback) {

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    // Pass to Pure javascript
                    if (response.done == true) {
                        callback(response.view);
                    } else {
                       callback(response.errorView);
                    }
                }
            };
            xhr.open(method, url, false);
            xhr.send(JSON.stringify(data));
        },
        createPublicationRequest: function (method, url, data, callback) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    callback();
                }
            };
            xhr.open(method, url, false);
            xhr.send(JSON.stringify(data));
        },
        add: function(view) {
            $('.spoti-content').html(view);
        },
        reload: function () {
            location.reload();
        }
    }
}());


