<?php
include_once $_SERVER['DOCUMENT_ROOT'].'../../main/www/classes/session.php';
include_once 'classes/header.php';
if(isset($_POST['email']))
{
  $email = $_POST['email'];
    $where = 'email="'.$accountDB->EscapeString($email).'"';
    $list = new Generallist($accountDB, 'activations', '*', $where, 'id', 1, 'DESC');
    $id = 0;
    $entry = $list->GetEntry($id);
    if($entry != null)
    {
      echo $entry['ID'];
      $activated = $account->Activate($entry['ID'], $entry['activationcode']);
      if($activated)
        echo $email.' wurde aktiviert.';
      else
        echo $email.' konnte nicht aktiviert werden, dieser Benutzername ist vermutlich vergeben oder die Email wird schon genutzt.';
    }
  
}

?>
<br/>
<br/>
<form method="POST" action="?a=activate">
  <input type="text" name="email" placeholder="email">
  <input type="submit" value="Aktivieren">
</form>