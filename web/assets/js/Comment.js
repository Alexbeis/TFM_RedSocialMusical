var Comment = (function () {

    var addUrl   = getBaseUrl() + '/create-comment/',
        id = 0;

    return {
        create: function (event) {
            event.preventDefault();
            var target = event.target;
            for (var i = 0; i < target.parentNode.childNodes.length; i++) {
               if ( target.parentNode.childNodes[i].tagName == "TEXTAREA") {
                   var message = target.parentNode.childNodes[i].value;
               }
            }
            var pub = target.getAttribute('data-pub'),
            data = {message:message, pub:pub};
            id = pub;
            if(message == "") {
                return;
            }
            this.Request('POST', addUrl, data);
        },
        Request: function (method, url, data) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText),
                        numComments = $('#num_comments_' + id);
                    if(response.done) {
                        $('#user_comments_' + id).html(response.view);
                        numComments.text(parseInt(numComments.text()) + 1);
                        $('#textarea_' + id).val('');
                    } else {
                        console.log(response.message);
                    }
                } else {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response.message);
                }
            };
            xhr.open(method, url, false);
            xhr.send(JSON.stringify(data));
        }
    }
}());
