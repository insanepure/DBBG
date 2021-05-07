<div class="spacer"></div>
<?php
if($entry != null)
{
  ?>
  <table width="100%" cellspacing="0">
  <tr>
  <td width="300px" class="catGradient borderT borderR borderL"><?php echo $entry->GetName(); ?></td>
  <td class="catGradient borderT borderL">Beschreibung</td>
  </tr> 
  <tr>
  <td class="borderT borderR borderL borderB">
  <table width="100%">
  <tr><td colspan="2"><img src="img/verzeichnis/<?php echo $entry->GetImage(); ?>.png?2" width="300px" height="300px"></img></td></tr>  
  <tr><td width="100px">Name:</td><td><?php echo $entry->GetName(); ?></td></tr>  
  <tr><td width="100px">Original:</td><td><?php echo $entry->GetOriginalName(); ?></td></tr>  
  <tr><td width="100px">Deutscher Voice Actor:</td><td><?php echo $entry->GetVoiceActorGer(); ?></td></tr>  
  <tr><td width="100px">Japanischer Voice Actor:</td><td><?php echo $entry->GetVoiceActorJap(); ?></td></tr>  
  <tr><td width="100px">Universum:</td><td><?php echo $entry->GetUniverse(); ?></td></tr>  
  <tr><td width="100px">Geburtsjahr:</td><td><?php echo $entry->GetBirthDay(); ?></td></tr>  
  <tr><td width="100px">Geburtsort:</td><td><?php echo $entry->GetBirthPlace(); ?></td></tr>  
  <tr><td width="100px">Größe:</td><td><?php echo $entry->GetHeight(); ?></td></tr>  
  <tr><td width="100px">Gewicht:</td><td><?php echo $entry->GetWeight(); ?></td></tr>  
  <tr><td width="100px">Familie:</td><td> <?php echo $bbcode->parse($entry->GetFamily()); ?></td></tr>  
  <tr><td width="100px">Debüt im Anime:</td><td><?php echo $entry->GetAnime(); ?></td></tr>  
  <tr><td width="100px">Debüt im Manga:</td><td><?php echo $entry->GetManga(); ?></td></tr>  
  </table>
  </td>
  <td class="borderT borderR borderB" valign="top">
  <?php echo $bbcode->parse($entry->GetDescription()); ?>
  </td>
  </tr>  
  </table>
  <br/>
  <a href="?p=verzeichnis">Zurück</a>
  <?php
}
else
{
?>
<div  class="catGradient borderT borderB" style="width:95%;">
  <b>Verzeichnis</b>
</div>
<form method="GET" action="?p=verzeichnis">
<table width="95%" cellspacing="0" border="0" class="borderT borderR borderL borderB">
<tr>
  <td> <input type="hidden" name="p" value="verzeichnis"></td>
	<td width="45%"><center><input style="width:100%;" type="text" name="searchname" value="<?php if(isset($_GET['searchname'])) echo $_GET['searchname']; ?>"></center></td>
  <td width="45%"><center><input type="submit" style="width:50%" value="Suchen"></center></td>
	</tr>
</table>
</form>
<div class="spacer"></div>

<table width="95%" cellspacing="0" border="0">
<tr>
<?php
$where = 'mainpage=1';
$limit = 10;
$mainPageList = new Generallist($database, 'verzeichnis', 'id, name, image', $where, '',  $limit, 'ASC');
$id = 0;
$entry = $mainPageList->GetEntry($id);
while($entry != null)
{
  if(($id % 5) == 0)
  {
    ?></tr><tr><?php
  }
  ?>
  <td>
    <a href="?p=verzeichnis&name=<?php echo $entry['name']; ?>">
    <div  class="catGradient borderT borderB" style="width:120px">
    <b><?php echo $entry['name']; ?></b>
    </div>
    <div class="borderR borderL borderB" style="width:120px">
    <img width="119px" height="119px" src="img/verzeichnis/<?php echo $entry['image']; ?>.png"></img>
    </div>
  </a>
  </td>
  <?php  
  ++$id;
  $entry = $mainPageList->GetEntry($id);
}
?>  
</tr> 
</table>
<div class="spacer"></div>
<div  class="catGradient borderT borderB" style="width:95%;">
  <b>Alle Einträge</b>
</div>
<div class="borderR borderL borderB" style="width:95%; text-align: left;">
 <table width="100%">
   <tr>
   <?php
    $letters = range('A', 'Z');
    foreach($letters as &$letter)
    {
      ?>
      <td>
        <?php if($_GET['search'] == $letter) { ?><b><?php } ?>
        <a href="?p=verzeichnis&search=<?php echo $letter; ?>"><?php echo $letter; ?></a>
        <?php if($_GET['search'] == $letter) { ?></b><?php } ?>
      </td>
      <?php
    }
    ?>
   </tr>
  </table>
  <?php
  if(isset($_GET['search']) && $_GET['search'] != '' || isset($_GET['searchname']) && $_GET['searchname'] != '')
  {
    if(isset($_GET['search']))
      $search = $database->EscapeString($_GET['search']);
    else if(isset($_GET['searchname']))
      $search = $database->EscapeString($_GET['searchname']);
    ?>
    <div class="spacer"></div>
    <h2><?php 
    if(isset($_GET['search']))
      echo $search; 
    else if(isset($_GET['searchname']))
      echo 'Suchwort: '.$search; 
      ?></h2>
    <ul style="text-align: left;">
    <?php
    if(isset($_GET['search']))
      $where = 'name LIKE "'.$search.'%"';
    else if(isset($_GET['searchname']))
      $where = 'name LIKE "%'.$search.'%"';
    $limit = 100;
    $searchEntries = new Generallist($database, 'verzeichnis', 'id, name, image', $where, '',  $limit, 'ASC');
    $id = 0;
    $entry = $searchEntries->GetEntry($id);
    while($entry != null)
    {
      ?>
      <li><img width="50px" height="50px" src="img/verzeichnis/<?php echo $entry['image']; ?>.png"></img> <a href="?p=verzeichnis&name=<?php echo $entry['name']; ?>"><?php echo $entry['name']; ?></a></li>
      <?php  
      ++$id;
      $entry = $searchEntries->GetEntry($id);
    }
    ?>  
    </ul>
    <?php
  }
  ?>
</div>
<?php
}
?>