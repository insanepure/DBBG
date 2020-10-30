<div class="spacer"></div>
<?php
//$regi wird in der head/register.php gesetzt
if ($account->IsLogged())
{
  if(!$charaCreationActive)
  {
    ?>
      <center>
        <h1><font color='red'>Die Charaktererstellung ist offline!</font></h1><br>
        Infos zur Charaktererstellung findet ihr in den News.<br>
        Mit Freundlichen Grüßen<br>
        Das Dragonball Browsergame Team
      </center>
    <?php
  }
  else
  {
?>
<div class="regimain borderT borderR borderL borderB">
  <div class="regiheader catGradient borderB">Registrierung</div>
  <div class="regchar borderT borderL borderR borderB"><img id="image" src="img/rasse.png" width="100%" height="100%" /></div>
  <div class="regimput">
    <form name="form1" action="?p=characreate&a=register" method="post">
    <input type="text" name="chara" placeholder="Charakter Name">
	  <div class="spacer"></div>
<script type="text/javascript">
function onRaceSelected(selectObject)
{
   var imageList = document.getElementById('raceimage');
   while (imageList.firstChild) 
   {
       imageList.removeChild(imageList.firstChild);
   }
   if(selectObject.value == 'Rasse')
   {
     imageList.options[imageList.options.length] = new Option('Bild', 'Rasse');
   }
   else
   {
     for(var i=1; i <= 4; ++i)
     {
       var bildName = 'Bild ' + i;
       var bildRace = selectObject.value + i;
       imageList.options[imageList.options.length] = new Option(bildName, bildRace);
     }
   }
   setRaceImage(imageList.options[0].value);
}
function onImageSelected(imageOption) 
{
  setRaceImage(imageOption.value);
}
function setRaceImage(imageName) 
{
  var img = document.getElementById("image");
  img.src = 'img/races/'+imageName+'.png';
}
</script>
    <select class="select" name="rasse" id="rasse" onchange="onRaceSelected(this)">
        <option value="Rasse">Rasse</option>
        <option value="Saiyajin">Saiyajin</option>
        <option value="Mensch">Mensch</option>
        <option value="Freezer">Freezer</option>
        <option value="Kaioshin">Kaioshin</option>
        <option value="Android">Android</option>
        <option value="Majin">Majin</option>
        <option value="Demon">Demon</option>
        <option value="Namekianer">Namekianer</option>
       </select><br>
	  <div class="spacer"></div>
    <select class="select" name="raceimage" id="raceimage" onchange="onImageSelected(this)">
        <option value="Rasse">Bild</option>
       </select><br>
    <div class="spacer"></div>
    <input type="submit" value="Registrieren">
    </form><br/>

    <div id="preloader">
     <img src="img/races/Rasse.png" width="1" height="1" />
     <img src="img/races/Saiyajin.png" width="1" height="1" />
     <img src="img/races/Mensch.png" width="1" height="1" />
     <img src="img/races/Freezer.png" width="1" height="1" />
     <img src="img/races/Kaioshin.png" width="1" height="1" />
     <img src="img/races/Cyborg.png" width="1" height="1" />
     <img src="img/races/Bio-Android.png" width="1" height="1" />
     <img src="img/races/Majin.png" width="1" height="1" />
     <img src="img/races/Demon.png" width="1" height="1" />
     <img src="img/races/Namekianer.png" width="1" height="1" />
    </div>
  </div> 
</div>

<div class="spacer"></div>

<center><b>Eingabehilfe</b></center>
<center><b><font color="0066FF">Charakter Name:</font></b> So wie du im Spiel heißen möchtest.</center>
<center><b><font color="0066FF">Rasse:</font></b> Entspricht deinen Lebenslaufweg im Spiel und desen Techniken.</center>
<div class="spacer"></div>
<?php
  }
}
else
{
  ?>
<div class="spacer"></div>
<img src="img/info.png" alt="regi" width="70%" height="300"> 
<hr>
Du musst dich zuerst einloggen, damit du einen Charakter erstellen kannst.<br/>
<div class="spacer"></div>
<?php
}
?>