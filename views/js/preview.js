function showPreview()
{
    var form = document.getElementById('file-form');
    var file = document.getElementById('file').files[0];
    var fd = new FormData();
    if(file)
    {
        fd.append('photo', file, file.name);
        myAjax('/default/preview', 'POST', fd, function()
        {
            var prewPhoto = document.getElementById('prewPhoto');
            prewPhoto.src = 'data:image/png;base64,' + req.responseText;
            var previewDiv = document.getElementById('previewDiv');
            previewDiv.style.display = 'block';

            var userName = document.getElementById('userName').value;
            var email = document.getElementById('email').value;
            var description = document.getElementById('description').value;

          document.getElementById('prewUserName').innerText  = userName;
          document.getElementById('prewEmail').innerText  = email;
          document.getElementById('prewDescription').innerText  = description;
        });
    }
}


function myAjax(query, type, formData, callback)
{
    req = getXmlHttpRequest();
    req.open(type, query, true);
    req.send(formData);
    req.onreadystatechange = function(){
        if (req.readyState != 4) return;
        callback();
    }
}

window.onload = function()
{
    var viewButton = document.getElementById("viewButton");
    if(viewButton)
    {
        viewButton.addEventListener('click', showPreview);
    }

}

function getXmlHttpRequest()
{
    if (window.XMLHttpRequest)
    {
        try
        {
            return new XMLHttpRequest();
        }
        catch (e){}
    }
    else if (window.ActiveXObject)
    {
        try
        {
            return new ActiveXObject('Msxml2.XMLHTTP');
        } catch (e){}
        try
        {
            return new ActiveXObject('Microsoft.XMLHTTP');
        }
        catch (e){}
    }
    return null;
}