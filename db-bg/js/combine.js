function SetData(doc, url)
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      doc.innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function SetItemData(documentID, listID)
{
  var listDoc = document.getElementById(listID);
  
  var selectedID = listDoc.options[listDoc.selectedIndex].value;
  var doc = document.getElementById(documentID);
  SetData(doc, "/pages/combineJS.php?id="+selectedID)
}