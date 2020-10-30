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

function AddTableRow(tablename, cells)
{
  var table = document.getElementById(tablename);
  var rowIndex = table.rows.length - 1;
  var row = table.insertRow(-1);
  for (i = 0; i < cells; i++) 
  { 
    SetCell(row.insertCell(i), "../pages/adminJS.php?table="+tablename+"&row="+rowIndex+"&cell="+i)
  }
}

function RemoveTableRow(tablename)
{
  var table = document.getElementById(tablename);
  table.deleteRow(-1);
}