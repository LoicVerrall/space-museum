function getXMLHttpReq () {
  let xmlHttpReq

  try {
    xmlHttpReq = new XMLHttpRequest()
  } catch (e) {
    try {
      xmlHttpReq = new ActiveXObject("Msxml2.XMLHTTP")
    } catch (e) {
      return false
    }
  }

  return xmlHttpReq
}

function generateGallery () {
  const xmlHttpReq = getXMLHttpReq()
  var send = 'index.php?page=gallery&resourceName=';

  xmlHttpReq.open('GET', send, true)
  xmlHttpReq.send(null)

  xmlHttpReq.onreadystatechange = function () {
    if (xmlHttpReq.readyState === 4) {
      const response = xmlHttpReq.responseText.split('~')
      var htmlCode
      for (var i = 0; i < response.length; i++) {
        htmlCode += '<p>' + response[i] + '</p>'
        // htmlCode += '<a href="./gallery/images/' + ' ">'
        // htmlCode += '<img class="card-img-top img-thumbnail" src="' + response[i] + '" id="image_thumbnail"/>';
        // htmlCode += '<p>IMAGE</p>'
        // htmlCode += '</a>'
      }

      document.getElementById('gallery_content').innerHTML = htmlCode
    }
  }
}
