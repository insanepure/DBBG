function SetCell(cell, url)
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      cell.innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function ChangeEdit(documentName, baseUrl, selectedObject)
{
  var selectedID = selectedObject.value;
  document.getElementById(documentName).href = baseUrl+selectedID;
}

function AddTableRow(tablename, cells)
{
  var table = document.getElementById(tablename);
  var rowIndex = table.rows.length - 1;
  var row = table.insertRow(-1);
  for (i = 0; i < cells; i++) 
  { 
    SetCell(row.insertCell(i), "../pages/adminJS.php?table="+tablename+"&row="+rowIndex+"&cell="+i);
  }
  SetCell(row.insertCell(cells), "../pages/adminJS.php?table="+tablename+"&row="+rowIndex+"&cell="+cells+"&delete");
}

function RemoveTableRow(elem)
{
  var table = elem.parentNode.parentNode.parentNode;
  var rowCount = table.rows.length;

  if(rowCount === 1) {
    alert('Cannot delete the last row');
    return;
  }

  // get the "<tr>" that is the parent of the clicked button
  var row = elem.parentNode.parentNode; 
  row.parentNode.removeChild(row); // remove the row
}