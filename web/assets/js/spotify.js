var SpotifyRequest = (function () {

    var searchUrl = getBaseUrl() + '/spotify/search',
        createUrl = getBaseUrl() + '/create-publication-spotify/new',
        method    = 'POST';

    return {
        search: function (e) {
             var song = document.getElementById('song').value;
             if (song == '') return;
             var data = {song :song};
             this.spotifyRequest(method , searchUrl, data);

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
            var data = {uri: uri};
            this.createPublicationRequest(method, createUrl, data);
        },

        spotifyRequest: function(method, url , data) {

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    // Pass to Pure javascript
                    console.log(response);
                    if (response.done == true) {
                        $('.spoti-content').html(response.view);
                    } else {
                        $('.spoti-content').html(response.errorView);
                    }


                }
            };
            xhr.open(method, url, false);
            xhr.send(JSON.stringify(data));
        },
        createPublicationRequest: function (method, url, data) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    //console.log(xhr.responseText);
                    location.reload();
                }
            };
            xhr.open(method, url, false);
            xhr.send(JSON.stringify(data));

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

