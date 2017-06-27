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
            var share = document.getElementById('share-button'),
                shareLen = share.parentNode.parentNode.childNodes.length;

            for (var i=0; i < shareLen; i++) {
                if(share.parentNode.parentNode.childNodes[i].classList != undefined  && share.parentNode.parentNode.childNodes[i].classList.contains('spoti-content')) {
                    for (var j=0; j < share.parentNode.parentNode.childNodes[i].childNodes.length; j++){
                        if (share.parentNode.parentNode.childNodes[i].childNodes[j].tagName == 'INPUT' ) {
                            var uri = share.parentNode.parentNode.childNodes[i].childNodes[j].getAttribute('data-uri');
                        }
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

//Spotify player responsive:
$(document).ready(function(){
    $('#spoti-iframe').each( function() {
        $(this).css('width',$(this).parent(1).css('width'));
        $(this).attr('src',$(this).attr('src'));
    });
});
$(window).resize(function() {
    $('#spoti-iframe').each( function() {
        $(this).css('width',$(this).parent(1).css('width'));
        $(this).attr('src',$(this).attr('src'));
    });
});

