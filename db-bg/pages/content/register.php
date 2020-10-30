<div class="logincontent">		
  
  <img width="300px" height="205,5px" src="img/info.png"></img>
  <div class="spacer"></div>
   Falls du schon ein Account beim <a href="https://n-bg.de/" target="_blank">Naruto Browsergame</a> hast,<br/>kannst du dich mit diesen beim <a href="?p=login">Login</a> einloggen.<br/>
  <div class="spacer"></div>
  <div class="logincontentlogin"> 
   <?php
   if($userRegisterActive)
   {
   ?>
   <form name="form1" action="?p=register&a=registrieren" method="post">
   <fieldset style="width:60%">
     <legend><b>Registrierung</b></legend>
     <table width="100%" cellspacing="8">
      <tr>
        <td width="30%" align="center"><b>Login</b></td>
        <td width="70%" align="center"><input type="text" name="acc"></td>
      </tr>  
      <tr>
        <td width="30%" align="center"><b>Passwort</b></td>
        <td width="70%" align="center"><input type="password" name="pw"></td>
      </tr>  
      <tr>
        <td width="30%" align="center"><b>Passwort wiederholen</b></td>
        <td width="70%" align="center"><input type="password" name="pw2"></td>
      </tr>  
      <tr>
        <td width="30%" align="center"><b>Email</b></td>
        <td width="70%" align="center"><input type="text" name="email"></td>
      </tr>  
      <tr>
        <td width="30%" align="center"><b>Email wiederholen</b></td>
        <td width="70%" align="center"><input type="text" name="email2"></td>
      </tr>  
      <tr>
        <td width="100%" align="center" colspan="2"><input type="checkbox" id="c1" name="regeln" /><label for="c1"><font color="#eee" class="schatten"> Ich habe die <a href="?p=info&info=regeln" target="_blank">Regeln</a> gelesen und akzeptiere sie.</font></label></td>
      </tr>  
      <tr>
        <td width="100%" align="center" colspan="2"><input type="submit" value="Registrieren"></td>
      </tr>  
     </table>
   </fieldset>
  </form>  
  <div class="spacer"></div>    
   <fieldset style="width:80%">
    <legend><b>Eingabehilfe:</b></legend>
      <table>
        <tr><td> <font color="0066FF">Loginname:</font></b> Dein Loginnamen, mit dem du dich einloggen kannst.</td></tr>
        <tr><td> <font color="0066FF">Passwort:</font></b> Ein sicheres und gut ausgewähltes Passwort.</td></tr>
        <tr><td> <font color="0066FF">Passwort wiederholen:</font></b> Das obige Passwort nochmal wiederholen.</td></tr>
        <tr><td> <font color="0066FF">Email:</font></b>Deine Email, damit wir dir einen Aktivierungscode zusenden können.</td></tr>
        <tr><td> <font color="0066FF">Email wiederholen:</font></b> Die obige Email nochmal wiederholen.</td></tr>
     </table>
   </fieldset>
   <?php
   }
   else
   {
   ?>
      <center>
        <h1><font color='red'>Die Anmeldung ist offline!</font></h1><br>
        Infos zur Anmeldung findet ihr in den News.<br>
        Mit Freundlichen Grüßen<br>
        Das Dragonball Browsergame Team
      </center>
   <?php
   }
   ?>
   <div class="spacer"></div> 
  </div>
  <div class="spacer"></div>
</div>
<div class="spacer2"></div>