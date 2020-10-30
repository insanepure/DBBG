var popup = null;
var popupHeader = null;
var popupContent = null;

function LoadPopup()
{
  popup = document.getElementById('popup');
  popupHeader = document.getElementById('popup-header');
  popupContent = document.getElementById('popup-content');
}

function OpenPopupMessage(header, content)
{
  popup.style.display = "block";
  popupHeader.textContent = header;
  popupContent.textContent = content;
  popup.addEventListener('click', ClosePopup);
  
}

function OpenPopupScript(content, params='')
{
  popup.removeEventListener('click', ClosePopup);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      var script = document.createElement('script');
      script.innerHTML = this.responseText;
      document.body.appendChild(script); 
    }
  };
  var url = "pages/popup/scripts/" + content;
  if(params !== '')
  {
    url = url + '?' + params;
  }
  xhttp.open("GET", url, true);
  xhttp.send();
}

function OpenPopupPage(header, content, params='')
{
  popup.removeEventListener('click', ClosePopup);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      popup.style.display = "block";
      popupHeader.textContent = header;
      popupContent.innerHTML = this.responseText;
      OpenPopupScript(content, params);
    }
  };
  var url = "pages/popup/" + content;
  if(params !== '')
  {
    url = url + '?' + params;
  }
  xhttp.open("GET", url, true);
  xhttp.send();
}

function ClosePopup()
{
  popup.style.display = "none";
}