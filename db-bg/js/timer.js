function loopTimer(timeoutDate, title, id)
{
  var currentDate = new Date();
  
  //calculate the difference in Milliseconds
  var diffInMilliseconds = timeoutDate - currentDate;
  
  //define default string
  var strZeit = "Fertig";  
  //if there is still time left
  if(diffInMilliseconds > 0)
  {
    var t = Math.ceil(diffInMilliseconds / 1000);
    var d = Math.floor(t/(60*60*24)); 
    var h = Math.floor(t/(60*60)) % 24;
    var m = Math.floor(t/60) %60;
    var s = t %60;

    d = (d >  0) ? d+"T ":"";
    h = (h < 10) ? "0"+h : h;
    m = (m < 10) ? "0"+m : m;
    s = (s < 10) ? "0"+s : s;
  
    strZeit =d + h + ":" + m + ":" + s;
    //recalculate 
    var delay = 500;
    setTimeout(function() 
    { 
      loopTimer(timeoutDate, title,id);
    }
    ,delay);
  }
  
  document.getElementById(id).innerHTML = strZeit;
  if(id == "cID")
    document.title = title+' - '+strZeit;
}

function countdown(time,id)
{
  var timeoutDate = new Date();
  var title = document.title;
  timeoutDate.setSeconds(timeoutDate.getSeconds() + time);
  loopTimer(timeoutDate, title, id);
}