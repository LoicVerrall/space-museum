function getXMLHttp() {
    var xmlHttpReq;

    try {
        xmlHttpReq = new XMLHttpRequest();
    } catch (e) {
        try {
            xmlHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            return false;
        }
    }

    return xmlHttpReq;
}

var xmlHttpReq = getXMLHttp();
var response;

var htmlCode = "";

$(document).ready(function() {
    var send = "../hook.php";
    xmlHttpReq.open("GET", send, true);
    xmlHttpReq.send(null);
    xmlHttpReq.onreadystatechange = function() {
        if (xmlHttpReq.readyState == 4) {
            response = xmlHttpReq.responseText.split("~");
            for (var i = 0; i < response.length; i++) {
                htmlCode += '<a href="./gallery/images/'+ response[i] +' ">';
                htmlCode += '<img class="card-img-top img-thumbnail" src="' + response[i] + '" id="image_thumbnail"/>';
                htmlCode += '</a>';
            }

            document.getElementById('gallery1').innerHTML = htmlCode;
            document.getElementById('gallery1').innerHTML = htmlCode;
            document.getElementById('gallery1').innerHTML = htmlCode;
        }
    }
});
