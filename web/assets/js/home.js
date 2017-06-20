var PublicationAjax = (function () {

    var removeUrl   = getBaseUrl() + '/delete-publication/';

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


        }
    }
}());

/** * Collects the App base url * @return {nothing} */
function getBaseUrl() {
    if (window.location.pathname.split('/')[1].indexOf('.php') > -1) {
        var baseUrl = window.location.protocol + '//' + window.location.hostname + '/' + window.location.pathname.split('/')[1];
    } else {
        var baseUrl = window.location.protocol + '//' + window.location.hostname;
    }
    return baseUrl;
};