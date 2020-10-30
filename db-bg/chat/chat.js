var channel = null;
var chatText = null;
var chatUsers = null;

var chatArray = null;

var chatArrayText = null;
var lastTime = 0;
var isActive = true;

var phpPath = 'https://'+window.location.hostname+'/chat/chatJS.php';


window.onfocus = function () { 
  isActive = true; 
}; 

window.onblur = function () { 
  isActive = false; 
}; 

function AddToArray(array, add)
{
  for(var i=0; i < add.length; ++i)
  {
    var msg = add[i];
    array.unshift(msg);
  }
  
  if(array.length > 30)
  {
    array.splice(30, array.length-30);
  }
  return array;
}

function DecodeArray(text)
{
  var decodedArray = [];
 text = text.replace(/(\r\n\t|\n|\r\t)/gm,"");
  
 var messages = text.split('{@BG@}');
 var alltext = '';
 for(var i=0; i < messages.length; ++i)
 {
   var message = messages[i].split('{@BGMSG@}');
   var id = message[0];
   var type = message[1];
   var time = message[2];
   var text = message[3];
   if(text === undefined)
   {
     continue;
   }
   decodedArray.push(message);
 }
 return decodedArray;
}

function EncodeArray(array)
{
  var codedString = "";
  for(var i=0; i < array.length; ++i)
  {
    var message = array[i];
    var id = message[0];
    var type = message[1];
    var time = message[2];
    var text = message[3];
    
    if(codedString === "")
    {
      codedString = message.join('{@BGMSG@}');
    }
    else
    {
      codedString = codedString+'{@BG@}'+message.join('{@BGMSG@}');
    }
  }
  return codedString;
}

function GetLastTimeFromArray(array)
{
  if(array == null || array.length === 0)
  {
    return 0;
  }
  return array[array.length-1][2];
}

function GetTextFromArray(array)
{
  var text = "";
  
  var toDelete = [];
  var displayedText = [];
  for(var i=0; i < array.length; ++i)
  {
    var message = array[i];
    
    if(message === undefined || message[3] === undefined)
    {
      continue;
    }
    
    if(message[1] == 2)
    {
      toDelete.push(message[3]);
    }
    else if(toDelete.indexOf(message[0]) == -1 && displayedText.indexOf(message[0]) == -1)
    {
      displayedText.push(message[0]);
      text += message[3];
    }
  }
  return text;
}

function GetCurrentDateTime()
{
  var now = new Date();
  var startOfDay = new Date(now.getFullYear(), now.getMonth(), now.getDate());
  return startOfDay / 1000;
}

function ClearSave()
{
  chatArray = [];
  lastTime = 0;
  chatArrayText = '';
  channel = '';
  chatText.innerHTML = "";
  SaveValues();
}

function Report()
{
  var xhttp = new XMLHttpRequest();
  var url = phpPath+"?a=report";
  xhttp.open("POST", url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  document.getElementById("chatReportButton").disabled = true;
  
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      document.getElementById("chatReportButton").disabled = false;
      console.log("Chat was reported");
      alert('Du hast den Chat reported, ein Admin wird es sich anschauen.');
    }
  };
  
  xhttp.send();
}

function SaveValues()
{
  chatArrayText = EncodeArray(chatArray);
  localStorage.setItem("lastTime", lastTime);
  localStorage.setItem("chatArrayText", chatArrayText);
  localStorage.setItem("chatChannel", channel);
  console.log("Saving current Chat Data ("+lastTime+")");
}

function LoadValues()
{
  if(localStorage.getItem("lastTime") == null || localStorage.getItem("chatArrayText") == null)
  {
    console.log("Local data is invalid, loading new Data");
    return;
  }
  
  lastTime = localStorage.getItem("lastTime");
  chatArrayText = localStorage.getItem("chatArrayText");
  channel = localStorage.getItem("chatChannel");
  
  console.log("Loaded Chat Data ("+lastTime+")");
  chatArray = DecodeArray(chatArrayText);
  
  chatText.innerHTML = GetTextFromArray(chatArray);
}

function InitChat(initChannel)
{
  chatText = document.getElementById('chat-text');
  chatUsers = document.getElementById('chat-users');
  chatArray = [];
  
  LoadValues();
  
  SetChannel(initChannel);
  
  var mSeconds = 1;
  mSeconds = mSeconds * 1000;
  var uSeconds = 60;
  uSeconds = uSeconds * 2000;
  setInterval(GetMessages, mSeconds);
  if(chatUsers)
  {
    setInterval(GetUsers, uSeconds);
  }
  
}
function GetUsers()
{
  if(chatUsers == null || !isActive)
  {
    return;
  }
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      chatUsers.innerHTML = this.responseText;
    }
  };
  var url = phpPath+"?a=users";
  xhttp.open("GET", url, true);
  xhttp.send();
}

function GetMessages()
{
  if(chatText == null || !isActive)
  {
    return;
  }
  
  var params = "lasttime=" + lastTime;
 
  var xhttp = new XMLHttpRequest();
  var url = phpPath+"?a=messages";
  xhttp.open("POST", url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      var response = this.responseText.replace(/(\r\n\t|\n|\r\t)/gm,"");
      if(response != '')
      {
        var messages = DecodeArray(response);
        lastTime = GetLastTimeFromArray(messages);
        chatArray = AddToArray(chatArray, messages);
        
        chatText.innerHTML = GetTextFromArray(chatArray);
        SaveValues();
      }
    }
  };
  xhttp.send(params);
}

function SendMessage()
{
  if(chatText == null)
  {
    return;
  }
  var messageDocument = document.getElementById('chatMessage');
  var message = messageDocument.value;
  var params = "message=" + message;
  
  var xhttp = new XMLHttpRequest();
  var url = phpPath+"?a=sendMessage";
  xhttp.open("POST", url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      GetMessages();
    }
  };
  
  xhttp.send(params);
  messageDocument.value = "";
}

function SetChannel(newChannel)
{
  GetUsers();
  if(channel == newChannel)
  {
    return;
  }
  console.log("Set Channel "+newChannel);
  
  lastTime = 0;
  chatText.innerHTML = '';
  channel = newChannel;
  GetMessages();
}

function DeleteMessage(messageID)
{
  var newChannel = '';
  var params = "id=" + messageID;
  
  var xhttp = new XMLHttpRequest();
  var url = phpPath+"?a=deleteMessage";
  xhttp.open("POST", url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      GetMessages();
    }
  };
  
  xhttp.send(params);
}

function ChatBanPlayer(messageID)
{
  var newChannel = '';
  var params = "id=" + messageID;
  
  var xhttp = new XMLHttpRequest();
  var url = phpPath+"?a=chatbanplayer";
  xhttp.open("POST", url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      GetMessages();
    }
  };
  
  xhttp.send(params);
}

function SwitchChannel()
{
  if(chatText == null)
  {
    return;
  }
  var newChannel = '';
  if(document.getElementById('chatChannel'))
  {
    newChannel = document.getElementById('chatChannel').value;
  }
  else if(document.getElementById('chat-select'))
  {
    var selectedDocument = document.getElementById('chat-select');
    newChannel = selectedDocument.options[selectedDocument.selectedIndex].text;
  }
  chatText.innerHTML = 'Loading Messages ...';
  if(chatUsers)
  {
    chatUsers.innerHTML = 'Loading Users ..';
  }
  var params = "channel=" + newChannel;
  
  var xhttp = new XMLHttpRequest();
  var url = phpPath+"?a=switchChannel";
  xhttp.open("POST", url, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200) 
    {
      ClearSave();
      SetChannel(newChannel);
    }
  };
  
  xhttp.send(params);
}