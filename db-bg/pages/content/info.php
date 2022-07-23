<?php
include_once 'classes/fight/attack.php';
?>
<div class="spacer"></div>
<table align="center"><tr><td>
<a href="?p=info&info=allgemeines">Allgemeines</a><br>
<a href="?p=info&info=rassen">Rassen</a><br>
<a href="?p=info&info=techniken">Techniken</a><br>    
<a href="?p=info&info=skilltree">Skilltree</a><br>    
<a href="?p=info&info=items">Items</a><br>
<a href="?p=info&info=clan">Clan</a><br>   
<a href="?p=info&info=dbs">Dragonballs</a><br> 
<a href="?p=info&info=coop">Co-Op</a><br> 
<a href="?p=info&info=events">Events</a><br> 
<a href="?p=info&info=boss">Boss</a><br> 
</td><td><img src="img/info.png" width="400" height="300"><br>
<center>
<a href="?p=info&info=faq">• Häufig gestellte Fragen</a><br>
  </center></td><td>
<a href="?p=info&info=chat">Chat</a><br>  
<a href="?p=info&info=spenden">Spenden</a><br>
<a href="?p=info&info=regeln">Regeln</a><br>  
<a href="?p=info&info=bbcode">BBCode</a><br>
<a href="?p=info&info=cookies">Cookies</a><br>
<a href="?p=info&info=dsgvo">Datenschutzverordnung</a><br>
<a href="?p=info&info=impressum">Impressum</a><br>
</td></tr></table>
<hr width="100%"><br>

<?php
if(isset($_GET['info']) && $_GET['info'] == 'skilltree')
{
  $skillpoints = 0;
  $race = 'Saiyajin';
  if(isset($_GET['race']))
  {
    $race = $_GET['race'];
  }
  $p = 'info&info=';
  $topOffset = -368;
  
  $tree = 1;
  if(isset($_GET['tree']))
    $tree = $_GET['tree'];
  
  
  $drace = 'Saiyajin'; if($race == $drace) { ?> <b> <?php } ?> <a href="?p=info&info=skilltree&race=<?php echo $drace; ?>&tree=<?php echo $tree; ?>"><?php echo $drace; ?></a> <?php if($race == $drace) { ?> </b> <?php } ?> | <?php
  $drace = 'Mensch'; if($race == $drace) { ?> <b> <?php } ?> <a href="?p=info&info=skilltree&race=<?php echo $drace; ?>&tree=<?php echo $tree; ?>"><?php echo $drace; ?></a> <?php if($race == $drace) { ?> </b> <?php }  ?> | <?php
  $drace = 'Freezer'; if($race == $drace) { ?> <b> <?php } ?> <a href="?p=info&info=skilltree&race=<?php echo $drace; ?>&tree=<?php echo $tree; ?>"><?php echo $drace; ?></a> <?php if($race == $drace) { ?> </b> <?php } ?> | <?php
  $drace = 'Kaioshin'; if($race == $drace) { ?> <b> <?php } ?> <a href="?p=info&info=skilltree&race=<?php echo $drace; ?>&tree=<?php echo $tree; ?>"><?php echo $drace; ?></a> <?php if($race == $drace) { ?> </b> <?php } ?> | <?php
  $drace = 'Android'; if($race == $drace) { ?> <b> <?php } ?> <a href="?p=info&info=skilltree&race=<?php echo $drace; ?>&tree=<?php echo $tree; ?>"><?php echo $drace; ?></a> <?php if($race == $drace) { ?> </b> <?php } ?> | <?php
  $drace = 'Majin'; if($race == $drace) { ?> <b> <?php } ?> <a href="?p=info&info=skilltree&race=<?php echo $drace; ?>&tree=<?php echo $tree; ?>"><?php echo $drace; ?></a> <?php if($race == $drace) { ?> </b> <?php } ?> | <?php
  $drace = 'Demon'; if($race == $drace) { ?> <b> <?php } ?> <a href="?p=info&info=skilltree&race=<?php echo $drace; ?>&tree=<?php echo $tree; ?>"><?php echo $drace; ?></a> <?php if($race == $drace) { ?> </b> <?php } ?> | <?php
  $drace = 'Namekianer'; if($race == $drace) { ?> <b> <?php } ?> <a href="?p=info&info=skilltree&race=<?php echo $drace; ?>&tree=<?php echo $tree; ?>"><?php echo $drace; ?></a> <?php if($race == $drace) { ?> </b> <?php } 
  include_once 'skilltree.php';
}

else if(isset($_GET['info']) && $_GET['info'] == 'boss')
{
  ?>
<table width="100%">
<?php
  $itemManager = new ItemManager($database);
  $where = 'isdungeon="1"';
  $events = new Generallist($database, 'events', '*', $where, 'level, id', 99999999999, 'ASC');
  $id = 0;
  $entry = $events->GetEntry($id);
  while($entry != null)
  {
    if(!$entry['displayinfo'])
    {
      ++$id;
      $entry = $events->GetEntry($id);
      continue;
    }
    $pandts = explode('@',$entry['placeandtime']);
	  $pandt = explode(';',$pandts[0]);
    
    
    ?>
      <tr><td><div class="catGradient borderT borderB"><center><b><?php echo $entry['name']; ?></b></center></div>
      <table>
        <tr>
          <td><img src="img/events/<?php echo $entry['image']; ?>.png" style="width:200px;height:300px;"></img></td>
          <td>
          <b><?php echo $entry['schedule']; ?></b><br/><br/>
          <b>Planet: <?php echo $pandt[0]; ?></b><br/>
          <b>Ort: <?php echo $pandt[1]; ?></b><br/>
          <?php if($entry['level'] != 0)
          {
            ?><b>Level: <?php echo $entry['level']; ?></b><br/><?php
          }
          ?>
          <b>Dropchance: <?php echo $entry['dropchance']; ?>%</b><br/>
          <b>Gewinn:<br/>
          <?php 
          if(!$entry['displayprice'])
          {
            echo '???';
          }
          else
          {
            if($entry['zeni'] != 0) echo $entry['zeni'].' Zeni<br/>'; 
            if($entry['item'] != '')
            {
                $items = explode(';',$entry['item']);
                foreach($items as $itemID)
                {
                  $item = $itemManager->GetItem($itemID);
                  echo '<img width="30px" height="30px" src="img/items/'.$item->GetImage().'.png"></img> '.$item->GetRealName().'<br/>';
                }
            }
          }
          ?>
          </b>
        
          </td>
        </tr>
        </table> 
      </td></tr>
    <?php
    ++$id;
    $entry = $events->GetEntry($id);
  }

?>
</table><br><br>
<?php
}

else if(isset($_GET['info']) && $_GET['info'] == 'events')
{
  ?>
<table width="100%">
<?php
  $itemManager = new ItemManager($database);
  $where = 'isdungeon="0"';
  $events = new Generallist($database, 'events', '*', $where, 'level, id', 99999999999, 'ASC');
  $id = 0;
  $entry = $events->GetEntry($id);
  while($entry != null)
  {
    if(!$entry['displayinfo'])
    {
      ++$id;
      $entry = $events->GetEntry($id);
      continue;
    }
    $pandts = explode('@',$entry['placeandtime']);
	  $pandt = explode(';',$pandts[0]);
    
    
    ?>
      <tr><td><div class="catGradient borderT borderB"><center><b><?php echo $entry['name']; ?></b></center></div>
      <table>
        <tr>
          <td><img src="img/events/<?php echo $entry['image']; ?>.png" style="width:200px;height:300px;"></img></td>
          <td>
          <b><?php echo $entry['schedule']; ?></b><br/><br/>
          <b>Planet: <?php echo $pandt[0]; ?></b><br/>
          <b>Ort: <?php echo $pandt[1]; ?></b><br/>
          <?php if($entry['level'] != 0)
          {
            ?><b>Level: <?php echo $entry['level']; ?></b><br/><?php
          }
          ?>
          <b>Dropchance: <?php echo $entry['dropchance']; ?>%</b><br/>
          <b>Gewinn: <br/>
          <?php 
          if(!$entry['displayprice'])
          {
            echo '???';
          }
          else
          {
            if($entry['zeni'] != 0) echo $entry['zeni'].' Zeni<br/>'; 
            if($entry['item'] != '')
            {
                $items = explode(';',$entry['item']);
                foreach($items as $itemID)
                {
                  $item = $itemManager->GetItem($itemID);
                  echo '<img width="30px" height="30px" src="img/items/'.$item->GetImage().'.png"></img> '.$item->GetRealName().'<br/>';
                }
            }
          }
          ?>
          </b>
        
          </td>
        </tr>
        </table> 
      </td></tr>
    <?php
    ++$id;
    $entry = $events->GetEntry($id);
  }

?>
</table><br><br>
<?php
}

else if(isset($_GET['info']) && $_GET['info'] == 'spenden')
{
  ?>
<table width="100%"><tr><td><div class="catGradient borderT borderB"><center><b>Spenden</b></center></div>
Wenn ihr das Browsergame cool findet und mich unterstützen wollt, so könnt ihr unter folgenden Link spenden: <b><a href="https://www.paypal.com/paypalme/insanepure?locale.x=de_DE">Paypal</a></b><br/>
Das Geld wird zusätzlich zur aktiven Werbung für die weitere Bezahlung der Server genutzt.<br/>
</td></tr></table><br><br>
<?php
}

else if(isset($_GET['info']) && $_GET['info'] == 'cookies')
{
  ?>
<table width="100%"><tr><td><div class="catGradient borderT borderB"><center><b>Cookies</b></center></div>
Wir nutzen Cookies um eure Logindaten verschlüsselt zu speichern und euch als User zu identifizieren.<br/>
Damit wird die Funktion "Eingeloggt bleiben" ermöglicht.<br/>
Ebenfalls werden Cookies für die Werbung (Google Adsense) und analysen (Google Analytics) genutzt, dies kommt jedoch von den entsprechenden Providern.<br/>
</td></tr></table><br><br>
<?php
}

else if(isset($_GET['info']) && $_GET['info'] == 'dsgvo')
{
  ?>
 <table width="100%"><tr><td><div class="catGradient borderT borderB"><center><b>Datenschutzverordnung</b></center></div>
<h2 id="m14">Einleitung</h2>
<p>Mit der folgenden Datenschutzerklärung möchten wir Sie darüber aufklären, welche Arten Ihrer personenbezogenen Daten (nachfolgend auch kurz als "Daten“ bezeichnet) wir zu welchen Zwecken und in welchem Umfang verarbeiten. Die Datenschutzerklärung gilt für alle von uns durchgeführten Verarbeitungen personenbezogener Daten, sowohl im Rahmen der Erbringung unserer Leistungen als auch insbesondere auf unseren Webseiten, in mobilen Applikationen sowie innerhalb externer Onlinepräsenzen, wie z.B. unserer Social-Media-Profile (nachfolgend zusammenfassend bezeichnet als "Onlineangebot“).</p>
<ul class="m-elements"></ul><p>Stand: 19. August 2019<h2>Inhaltsübersicht</h2> <ul class="index"><li><a class="index-link" href="#m14"> Einleitung</a></li><li><a class="index-link" href="#m3"> Verantwortlicher</a></li><li><a class="index-link" href="#mOverview"> Übersicht der Verarbeitungen</a></li><li><a class="index-link" href="#m13"> Maßgebliche Rechtsgrundlagen</a></li><li><a class="index-link" href="#m27"> Sicherheitsmaßnahmen</a></li><li><a class="index-link" href="#m25"> Übermittlung und Offenbarung von personenbezogenen Daten</a></li><li><a class="index-link" href="#m24"> Datenverarbeitung in Drittländern</a></li><li><a class="index-link" href="#m134"> Einsatz von Cookies</a></li><li><a class="index-link" href="#m367"> Registrierung und Anmeldung</a></li><li><a class="index-link" href="#m182"> Kontaktaufnahme</a></li><li><a class="index-link" href="#m391"> Kommunikation via Messenger</a></li><li><a class="index-link" href="#m225"> Bereitstellung des Onlineangebotes und Webhosting</a></li><li><a class="index-link" href="#m29"> Cloud-Dienste</a></li><li><a class="index-link" href="#m17"> Newsletter und Breitenkommunikation</a></li><li><a class="index-link" href="#m263"> Webanalyse und Optimierung</a></li><li><a class="index-link" href="#m264"> Onlinemarketing</a></li><li><a class="index-link" href="#m136"> Präsenzen in sozialen Netzwerken</a></li><li><a class="index-link" href="#m328"> Plugins und eingebettete Funktionen sowie Inhalte</a></li><li><a class="index-link" href="#m12"> Löschung von Daten</a></li><li><a class="index-link" href="#m15"> Änderung und Aktualisierung der Datenschutzerklärung</a></li><li><a class="index-link" href="#m10"> Rechte der betroffenen Personen</a></li><li><a class="index-link" href="#m42"> Begriffsdefinitionen</a></li></ul><h2 id="m3">Verantwortlicher</h2> <p>André Braun<br>Obergasse 11A<br>55576 Welgesheim</p>
<p><strong>E-Mail-Adresse</strong>: <a href="mailto:p-u-r-e@hotmail.de">p-u-r-e@hotmail.de</a></p>
<ul class="m-elements"></ul><h2 id="mOverview">Übersicht der Verarbeitungen</h2><p>Die nachfolgende Übersicht fasst die Arten der verarbeiteten Daten und die Zwecke ihrer Verarbeitung zusammen und verweist auf die betroffenen Personen.</p><h3>Arten der verarbeiteten Daten</h3>
<ul><li><p>Bestandsdaten (z.B. Namen, Adressen).</p></li><li><p>Inhaltsdaten  (z.B. Texteingaben, Fotografien, Videos).</p></li><li><p>Kontaktdaten (z.B. E-Mail, Telefonnummern).</p></li><li><p>Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen).</p></li><li><p>Nutzungsdaten  (z.B. besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten).</p></li><li><p>Standortdaten (Daten, die den Standort des Endgeräts eines Endnutzers angeben).</p></li></ul><h3>Kategorien betroffener Personen</h3><ul><li><p>Beschäftigte (z.B. Angestellte, Bewerber, ehemalige Mitarbeiter).</p></li><li><p>Interessenten.</p></li><li><p>Kommunikationspartner.</p></li><li><p>Kunden.</p></li><li><p>Nutzer (z.B. Webseitenbesucher, Nutzer von Onlinediensten).</p></li></ul><h3>Zwecke der Verarbeitung</h3><ul><li><p>Bereitstellung unseres Onlineangebotes und Nutzerfreundlichkeit.</p></li><li><p>Besuchsaktionsauswertung.</p></li><li><p>Büro- und Organisationsverfahren.</p></li><li><p>Cross-Device Tracking (geräteübergreifende Verarbeitung von Nutzerdaten für Marketingzwecke).</p></li><li><p>Direktmarketing (z.B. per E-Mail oder postalisch).</p></li><li><p>Interessenbasiertes und verhaltensbezogenes Marketing.</p></li><li><p>Kontaktanfragen und Kommunikation.</p></li><li><p>Konversionsmessung (Messung der Effektivität von Marketingmaßnahmen).</p></li><li><p>Profiling (Erstellen von Nutzerprofilen).</p></li><li><p>Remarketing.</p></li><li><p>Reichweitenmessung (z.B. Zugriffsstatistiken, Erkennung wiederkehrender Besucher).</p></li><li><p>Sicherheitsmaßnahmen.</p></li><li><p>Tracking (z.B. interessens-/verhaltensbezogenes Profiling, Nutzung von Cookies).</p></li><li><p>Vertragliche Leistungen und Service.</p></li><li><p>Verwaltung und Beantwortung von Anfragen.</p></li><li><p>Zielgruppenbildung (Bestimmung von für Marketingzwecke relevanten Zielgruppen oder sonstige Ausgabe von Inhalten).</p></li></ul><h2></h2><h3 id="m13">Maßgebliche Rechtsgrundlagen</h3><p>Im Folgenden teilen wir die Rechtsgrundlagen der Datenschutzgrundverordnung (DSGVO), auf deren Basis wir die personenbezogenen Daten verarbeiten, mit. Bitte beachten Sie, dass zusätzlich zu den Regelungen der DSGVO die nationalen Datenschutzvorgaben in Ihrem bzw. unserem Wohn- und Sitzland gelten können.</p>
 <ul><li><p><strong>Einwilligung (Art. 6 Abs. 1 S. 1 lit. a DSGVO)</strong> - Die betroffene Person hat ihre Einwilligung in die Verarbeitung der sie betreffenden personenbezogenen Daten für einen spezifischen Zweck oder mehrere bestimmte Zwecke gegeben.</p></li><li><p><strong>Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b. DSGVO)</strong> - Die Verarbeitung ist für die Erfüllung eines Vertrags, dessen Vertragspartei die betroffene Person ist, oder zur Durchführung vorvertraglicher Maßnahmen erforderlich, die auf Anfrage der betroffenen Person erfolgen.</p></li><li><p><strong>Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO)</strong> - Die Verarbeitung ist zur Wahrung der berechtigten Interessen des Verantwortlichen oder eines Dritten erforderlich, sofern nicht die Interessen oder Grundrechte und Grundfreiheiten der betroffenen Person, die den Schutz personenbezogener Daten erfordern, überwiegen.</p></li></ul><p><strong>Nationale Datenschutzregelungen in Deutschland</strong>: Zusätzlich zu den Datenschutzregelungen der Datenschutz-Grundverordnung gelten nationale Regelungen zum Datenschutz in Deutschland. Hierzu gehört insbesondere das Gesetz zum Schutz vor Missbrauch personenbezogener Daten bei der Datenverarbeitung (Bundesdatenschutzgesetz – BDSG). Das BDSG enthält insbesondere Spezialregelungen zum Recht auf Auskunft, zum Recht auf Löschung, zum Widerspruchsrecht, zur Verarbeitung besonderer Kategorien personenbezogener Daten, zur Verarbeitung für andere Zwecke und zur Übermittlung sowie automatisierten Entscheidungsfindung im Einzelfall einschließlich Profiling. Des Weiteren regelt es die Datenverarbeitung für Zwecke des Beschäftigungsverhältnisses (§ 26 BDSG), insbesondere im Hinblick auf die Begründung, Durchführung oder Beendigung von Beschäftigungsverhältnissen sowie die Einwilligung von Beschäftigten. Ferner können Landesdatenschutzgesetze der einzelnen Bundesländer zur Anwendung gelangen.</p>
<ul class="m-elements"></ul> <h2 id="m27">Sicherheitsmaßnahmen</h2><p>Wir treffen nach Maßgabe der gesetzlichen Vorgaben unter Berücksichtigung des Stands der Technik, der Implementierungskosten und der Art, des Umfangs, der Umstände und der Zwecke der Verarbeitung sowie der unterschiedlichen Eintrittswahrscheinlichkeiten und des Ausmaßes der Bedrohung der Rechte und Freiheiten natürlicher Personen geeignete technische und organisatorische Maßnahmen, um ein dem Risiko angemessenes Schutzniveau zu gewährleisten.</p>
<p>Zu den Maßnahmen gehören insbesondere die Sicherung der Vertraulichkeit, Integrität und Verfügbarkeit von Daten durch Kontrolle des physischen und elektronischen Zugangs zu den Daten als auch des sie betreffenden Zugriffs, der Eingabe, der Weitergabe, der Sicherung der Verfügbarkeit und ihrer Trennung. Des Weiteren haben wir Verfahren eingerichtet, die eine Wahrnehmung von Betroffenenrechten, die Löschung von Daten und Reaktionen auf die Gefährdung der Daten gewährleisten. Ferner berücksichtigen wir den Schutz personenbezogener Daten bereits bei der Entwicklung bzw. Auswahl von Hardware, Software sowie Verfahren entsprechend dem Prinzip des Datenschutzes, durch Technikgestaltung und durch datenschutzfreundliche Voreinstellungen.</p>
<p><strong>Kürzung der IP-Adresse</strong>: Sofern es uns möglich ist oder eine Speicherung der IP-Adresse nicht erforderlich ist, kürzen wir oder lassen Ihre IP-Adresse kürzen. Im Fall der Kürzung der IP-Adresse, auch als "IP-Masking" bezeichnet, wird das letzte Oktett, d.h., die letzten beiden Zahlen einer IP-Adresse, gelöscht (die IP-Adresse ist in diesem Kontext eine einem Internetanschluss durch den Online-Zugangs-Provider individuell zugeordnete Kennung). Mit der Kürzung der IP-Adresse soll die Identifizierung einer Person anhand ihrer IP-Adresse verhindert oder wesentlich erschwert werden.</p>
<p><strong>SSL-Verschlüsselung (https)</strong>: Um Ihre via unser Online-Angebot übermittelten Daten zu schützen, nutzen wir eine SSL-Verschlüsselung. Sie erkennen derart verschlüsselte Verbindungen an dem Präfix https:// in der Adresszeile Ihres Browsers.</p>
<h2 id="m25">Übermittlung und Offenbarung von personenbezogenen Daten</h2><p>Im Rahmen unserer Verarbeitung von personenbezogenen Daten kommt es vor, dass die Daten an andere Stellen, Unternehmen, rechtlich selbstständige Organisationseinheiten oder Personen übermittelt oder sie ihnen gegenüber offengelegt werden. Zu den Empfängern dieser Daten können z.B. Zahlungsinstitute im Rahmen von Zahlungsvorgängen, mit IT-Aufgaben beauftragte Dienstleister oder Anbieter von Diensten und Inhalten, die in eine Webseite eingebunden werden, gehören. In solchen Fall beachten wir die gesetzlichen Vorgaben und schließen insbesondere entsprechende Verträge bzw. Vereinbarungen, die dem Schutz Ihrer Daten dienen, mit den Empfängern Ihrer Daten ab.</p>
<h2 id="m24">Datenverarbeitung in Drittländern</h2><p>Sofern wir Daten in einem Drittland (d.h., außerhalb der Europäischen Union (EU), des Europäischen Wirtschaftsraums (EWR)) verarbeiten oder die Verarbeitung im Rahmen der Inanspruchnahme von Diensten Dritter oder der Offenlegung bzw. Übermittlung von Daten an andere Personen, Stellen oder Unternehmen stattfindet, erfolgt dies nur im Einklang mit den gesetzlichen Vorgaben. </p>
<p>Vorbehaltlich ausdrücklicher Einwilligung oder vertraglich oder gesetzlich erforderlicher Übermittlung verarbeiten oder lassen wir die Daten nur in Drittländern mit einem anerkannten Datenschutzniveau, zu denen die unter dem "Privacy-Shield" zertifizierten US-Verarbeiter gehören, oder auf Grundlage besonderer Garantien, wie z.B. vertraglicher Verpflichtung durch sogenannte Standardschutzklauseln der EU-Kommission, des Vorliegens von Zertifizierungen oder verbindlicher interner Datenschutzvorschriften, verarbeiten (Art. 44 bis 49 DSGVO, Informationsseite der EU-Kommission: <a href="https://ec.europa.eu/info/law/law-topic/data-protection/international-dimension-data-protection_de" target="_blank">https://ec.europa.eu/info/law/law-topic/data-protection/international-dimension-data-protection_de</a> ).</p>
<h2 id="m134">Einsatz von Cookies</h2><p>Als "Cookies“ werden kleine Dateien bezeichnet, die auf Geräten der Nutzer gespeichert werden. Mittels Cookies können unterschiedliche Angaben gespeichert werden. Zu den Angaben können z.B. die Spracheinstellungen auf einer Webseite, der Loginstatus, ein Warenkorb oder die Stelle, an der ein Video geschaut wurde, gehören. </p>
<p>Cookies werden im Regelfall auch dann eingesetzt, wenn die Interessen eines Nutzers oder sein Verhalten (z.B. Betrachten bestimmter Inhalte, Nutzen von Funktionen etc.) auf einzelnen Webseiten in einem Nutzerprofil gespeichert werden. Solche Profile dienen dazu, den Nutzern z.B. Inhalte anzuzeigen, die ihren potentiellen Interessen entsprechen. Dieses Verfahren wird auch als "Tracking", d.h., Nachverfolgung der potentiellen Interessen der Nutzer bezeichnet. Zu dem Begriff der Cookies zählen wir ferner andere Technologien, die die gleichen Funktionen wie Cookies erfüllen (z.B., wenn Angaben der Nutzer anhand pseudonymer Onlinekennzeichnungen gespeichert werden, auch als "Nutzer-IDs" bezeichnet).</p>
<p>Soweit wir Cookies oder "Tracking"-Technologien einsetzen, informieren wir Sie gesondert in unserer Datenschutzerklärung. </p>
<p><strong>Hinweise zu Rechtsgrundlagen: </strong> Auf welcher Rechtsgrundlage wir Ihre personenbezogenen Daten mit Hilfe von Cookies verarbeiten, hängt davon ab, ob wir Sie um eine Einwilligung bitten. Falls dies zutrifft und Sie in die Nutzung von Cookies einwilligen, ist die Rechtsgrundlage der Verarbeitung Ihrer Daten die erklärte Einwilligung. Andernfalls werden die mithilfe von Cookies verarbeiteten Daten auf Grundlage unserer berechtigten Interessen (z.B. an einem betriebswirtschaftlichen Betrieb unseres Onlineangebotes und dessen Verbesserung) verarbeitet oder, wenn der Einsatz von Cookies erforderlich ist, um unsere vertraglichen Verpflichtungen zu erfüllen.</p>
<p><strong>Widerruf und Widerspruch (Opt-Out): </strong> Unabhängig davon, ob die Verarbeitung auf Grundlage einer Einwilligung oder gesetzlichen Erlaubnis erfolgt, haben Sie jederzeit die Möglichkeit, eine erteilte Einwilligung zu widerrufen oder der Verarbeitung Ihrer Daten durch Cookie-Technologien zu widersprechen (zusammenfassend als "Opt-Out" bezeichnet).</p>
<p>Sie können Ihren Widerspruch zunächst mittels der Einstellungen Ihres Browsers erklären, z.B., indem Sie die Nutzung von Cookies deaktivieren (wobei hierdurch auch die Funktionsfähigkeit unseres Onlineangebotes eingeschränkt werden kann).</p>
<p>Ein Widerspruch gegen den Einsatz von Cookies zu Zwecken des Onlinemarketings kann mittels einer Vielzahl von Diensten, vor allem im Fall des Trackings, über die US-amerikanische Seite <a href="http://www.aboutads.info/choices/" target="_blank">http://www.aboutads.info/choices/</a> oder die EU-Seite <a href="http://www.youronlinechoices.com/" target="_blank">http://www.youronlinechoices.com/</a> oder generell auf <a href="http://optout.aboutads.info" target="_blank">http://optout.aboutads.info</a> erklärt werden.</p>
<p><strong>Verarbeitung von Cookie-Daten auf Grundlage einer Einwilligung</strong>: Bevor wir Daten im Rahmen der Nutzung von Cookies verarbeiten oder verarbeiten lassen, bitten wir die Nutzer um eine jederzeit widerrufbare Einwilligung. Bevor die Einwilligung nicht ausgesprochen wurde, werden allenfalls Cookies eingesetzt, die für den Betrieb unseres Onlineangebotes erforderlich sind. Deren Einsatz erfolgt auf der Grundlage unseres Interesses und des Interesses der Nutzer an der erwarteten Funktionsfähigkeit unseres Onlineangebotes.</p>
<ul class="m-elements"><li><p><strong>Verarbeitete Datenarten:</strong> Nutzungsdaten  (z.B. besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten), Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen).</p></li><li><p><strong>Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von Onlinediensten).</p></li><li><p><strong>Rechtsgrundlagen:</strong> Einwilligung (Art. 6 Abs. 1 S. 1 lit. a DSGVO), Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li></ul><h2 id="m367">Registrierung und Anmeldung</h2><p>Nutzer können ein Nutzerkonto anlegen. Im Rahmen der Registrierung werden den Nutzern die erforderlichen Pflichtangaben mitgeteilt und zu Zwecken der Bereitstellung des Nutzerkontos auf Grundlage vertraglicher Pflichterfüllung verarbeitet. Zu den verarbeiteten Daten gehören insbesondere die Login-Informationen (Name, Passwort sowie eine E-Mail-Adresse). Die im Rahmen der Registrierung eingegebenen Daten werden für die Zwecke der Nutzung des Nutzerkontos und dessen Zwecks verwendet. </p>
<p>Die Nutzer können über Vorgänge, die für deren Nutzerkonto relevant sind, wie z.B. technische Änderungen, per E-Mail informiert werden. Wenn Nutzer ihr Nutzerkonto gekündigt haben, werden deren Daten im Hinblick auf das Nutzerkonto, vorbehaltlich einer gesetzlichen Aufbewahrungspflicht, gelöscht. Es obliegt den Nutzern, ihre Daten bei erfolgter Kündigung vor dem Vertragsende zu sichern. Wir sind berechtigt, sämtliche während der Vertragsdauer gespeicherte Daten des Nutzers unwiederbringlich zu löschen.</p>
<p>Im Rahmen der Inanspruchnahme unserer Registrierungs- und Anmeldefunktionen sowie der Nutzung des Nutzerkontos speichern wir die IP-Adresse und den Zeitpunkt der jeweiligen Nutzerhandlung. Die Speicherung erfolgt auf Grundlage unserer berechtigten Interessen als auch jener der Nutzer an einem Schutz vor Missbrauch und sonstiger unbefugter Nutzung. Eine Weitergabe dieser Daten an Dritte erfolgt grundsätzlich nicht, es sei denn, sie ist zur Verfolgung unserer Ansprüche erforderlich oder es besteht hierzu besteht eine gesetzliche Verpflichtung.</p>
<ul class="m-elements"><li><p><strong>Verarbeitete Datenarten:</strong> Bestandsdaten (z.B. Namen, Adressen), Kontaktdaten (z.B. E-Mail, Telefonnummern), Inhaltsdaten  (z.B. Texteingaben, Fotografien, Videos), Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen).</p></li><li><p><strong>Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von Onlinediensten).</p></li><li><p><strong>Zwecke der Verarbeitung:</strong> Vertragliche Leistungen und Service, Sicherheitsmaßnahmen, Verwaltung und Beantwortung von Anfragen.</p></li><li><p><strong>Rechtsgrundlagen:</strong> Einwilligung (Art. 6 Abs. 1 S. 1 lit. a DSGVO), Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b. DSGVO), Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li></ul><h2 id="m182">Kontaktaufnahme</h2><p>Bei der Kontaktaufnahme mit uns (z.B. per Kontaktformular, E-Mail, Telefon oder via soziale Medien) werden die Angaben der anfragenden Personen verarbeitet, soweit dies zur Beantwortung der Kontaktanfragen und etwaiger angefragter Maßnahmen erforderlich ist.</p>
<p>Die Beantwortung der Kontaktanfragen im Rahmen von vertraglichen oder vorvertraglichen Beziehungen erfolgt zur Erfüllung unserer vertraglichen Pflichten oder zur Beantwortung von (vor)vertraglichen Anfragen und im Übrigen auf Grundlage der berechtigten Interessen an der Beantwortung der Anfragen.</p>
<p><strong>Chat-Funktion</strong>: Zu Zwecken der Kommunikation und der Beantwortung von Anfragen bieten wir innerhalb unseres Onlineangebotes eine Chat-Funktion an. Die Eingaben der Nutzer innerhalb des Chats werden für Zwecke der Beantwortung ihrer Anfragen verarbeitet.</p>
<ul class="m-elements"><li><p><strong>Verarbeitete Datenarten:</strong> Bestandsdaten (z.B. Namen, Adressen), Kontaktdaten (z.B. E-Mail, Telefonnummern), Inhaltsdaten  (z.B. Texteingaben, Fotografien, Videos), Nutzungsdaten  (z.B. besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten), Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen).</p></li><li><p><strong>Betroffene Personen:</strong> Kommunikationspartner, Interessenten.</p></li><li><p><strong>Zwecke der Verarbeitung:</strong> Kontaktanfragen und Kommunikation, Verwaltung und Beantwortung von Anfragen.</p></li><li><p><strong>Rechtsgrundlagen:</strong> Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b. DSGVO), Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li></ul><h2 id="m391">Kommunikation via Messenger</h2><p>Wir setzen zu Zwecken der Kommunikation Messenger-Dienste ein und bitten daher darum, die nachfolgenden Hinweise zur Funktionsfähigkeit der Messenger, zur Verschlüsselung, zur Nutzung der Metadaten der Kommunikation und zu Ihren Widerspruchsmöglichkeiten zu beachten.</p>
<p>Sie können uns auch auf alternativen Wegen, z.B. via Telefon oder E-Mail, kontaktieren. Bitte nutzen Sie die Ihnen mitgeteilten Kontaktmöglichkeiten oder die innerhalb unseres Onlineangebotes angegebenen Kontaktmöglichkeiten.</p>
<p>Im Fall einer Ende-zu-Ende-Verschlüsselung von Inhalten (d.h., der Inhalt Ihrer Nachricht und Anhänge) weisen wir darauf hin, dass die Kommunikationsinhalte (d.h., der Inhalt der Nachricht und angehängte Bilder) von Ende zu Ende verschlüsselt werden. Das bedeutet, dass der Inhalt der Nachrichten nicht einsehbar ist, nicht einmal durch die Messenger-Anbieter selbst. Sie sollten immer eine aktuelle Version der Messenger mit aktivierter Verschlüsselung nutzen, damit die Verschlüsselung der Nachrichteninhalte sichergestellt ist. </p>
<p>Wir weisen unsere Kommunikationspartner jedoch zusätzlich darauf hin, dass die Anbieter der Messenger zwar nicht den Inhalt einsehen, aber in Erfahrung bringen können, dass und wann Kommunikationspartner mit uns kommunizieren sowie technische Informationen zum verwendeten Gerät der Kommunikationspartner und je nach Einstellungen ihres Gerätes auch Standortinformationen (sogenannte Metadaten) verarbeitet werden.</p>
<p><strong>Hinweise zu Rechtsgrundlagen: </strong> Sofern wir Kommunikationspartner vor der Kommunikation mit ihnen via Messenger um eine Erlaubnis bitten, ist die Rechtsgrundlage unserer Verarbeitung ihrer Daten deren Einwilligung. Im Übrigen, falls wir nicht um eine Einwilligung bitten und sie z.B. von sich aus Kontakt mit uns aufnehmen, nutzen wir Messenger im Verhältnis zu unseren Vertragspartnern sowie im Rahmen der Vertragsanbahnung als eine vertragliche Maßnahme und im Fall anderer Interessenten und Kommunikationspartner auf Grundlage unserer berechtigten Interessen an einer schnellen und effizienten Kommunikation und Erfüllung der Bedürfnisse unser Kommunikationspartner an der Kommunikation via Messengern. Ferner weisen wir Sie darauf hin, dass wir die uns mitgeteilten Kontaktdaten ohne Ihre Einwilligung nicht erstmalig an die Messenger übermitteln.</p>
<p><strong>Widerruf, Widerspruch und Löschung:</strong> Sie können jederzeit eine erteilte Einwilligung widerrufen und der Kommunikation mit uns via Messenger jederzeit widersprechen. Im Fall der Kommunikation via Messenger löschen wir die Nachrichten entsprechend unseren generellen Löschrichtlinien (d.h. z.B., wie oben beschrieben, nach Ende vertraglicher Beziehungen, im Kontext von Archivierungsvorgaben etc.) und sonst, sobald wir davon ausgehen können, etwaige Auskünfte der Kommunikationspartner beantwortet zu haben, wenn kein Rückbezug auf eine vorhergehende Konversation zu erwarten ist und der Löschung keine gesetzlichen Aufbewahrungspflichten entgegenstehen.</p>
<p><strong>Vorbehalt des Verweises auf andere Kommunikationswege:</strong> Zum Abschluss möchten wir darauf hinweisen, dass wir uns aus Gründen Ihrer Sicherheit vorbehalten, Anfragen über Messenger nicht zu beantworten. Das ist der Fall, wenn z.B. Vertragsinterna besonderer Geheimhaltung bedürfen oder eine Antwort über den Messenger den formellen Ansprüchen nicht genügt. In solchen Fällen verweisen wir Sie auf adäquatere Kommunikationswege.</p>
<ul class="m-elements"><li><p><strong>Verarbeitete Datenarten:</strong> Kontaktdaten (z.B. E-Mail, Telefonnummern), Nutzungsdaten  (z.B. besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten), Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen).</p></li><li><p><strong>Betroffene Personen:</strong> Kommunikationspartner.</p></li><li><p><strong>Zwecke der Verarbeitung:</strong> Kontaktanfragen und Kommunikation, Direktmarketing (z.B. per E-Mail oder postalisch).</p></li><li><p><strong>Rechtsgrundlagen:</strong> Einwilligung (Art. 6 Abs. 1 S. 1 lit. a DSGVO), Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li></ul><h2 id="m225">Bereitstellung des Onlineangebotes und Webhosting</h2><p>Um unser Onlineangebot sicher und effizient bereitstellen zu können, nehmen wir die Leistungen von einem oder mehreren Webhosting-Anbietern in Anspruch, von deren Servern (bzw. von ihnen verwalteten Servern) das Onlineangebot abgerufen werden kann. Zu diesen Zwecken können wir Infrastruktur- und Plattformdienstleistungen, Rechenkapazität, Speicherplatz und Datenbankdienste sowie Sicherheitsleistungen und technische Wartungsleistungen in Anspruch nehmen.</p>
<p>Zu den im Rahmen der Bereitstellung des Hostingangebotes verarbeiteten Daten können alle die Nutzer unseres Onlineangebotes betreffenden Angaben gehören, die im Rahmen der Nutzung und der Kommunikation anfallen. Hierzu gehören regelmäßig die IP-Adresse, die notwendig ist, um die Inhalte von Onlineangeboten an Browser ausliefern zu können, und alle innerhalb unseres Onlineangebotes oder von Webseiten getätigten Eingaben.</p>
<p><strong>E-Mail-Versand und -Hosting</strong>: Die von uns in Anspruch genommenen Webhosting-Leistungen umfassen ebenfalls den Versand, den Empfang sowie die Speicherung von E-Mails. Zu diesen Zwecken werden die Adressen der Empfänger sowie Absender als auch weitere Informationen betreffend den E-Mailversand (z.B. die beteiligten Provider) sowie die Inhalte der jeweiligen E-Mails verarbeitet. Die vorgenannten Daten können ferner zu Zwecken der Erkennung von SPAM verarbeitet werden. Wir bitten darum, zu beachten, dass E-Mails im Internet grundsätzlich nicht verschlüsselt versendet werden. Im Regelfall werden E-Mails zwar auf dem Transportweg verschlüsselt, aber (sofern kein sogenanntes Ende-zu-Ende-Verschlüsselungsverfahren eingesetzt wird) nicht auf den Servern, von denen sie abgesendet und empfangen werden. Wir können daher für den Übertragungsweg der E-Mails zwischen dem Absender und dem Empfang auf unserem Server keine Verantwortung übernehmen.</p>
<p><strong>Erhebung von Zugriffsdaten und Logfiles</strong>: Wir selbst (bzw. unser Webhostinganbieter) erheben Daten zu jedem Zugriff auf den Server (sogenannte Serverlogfiles). Zu den Serverlogfiles können die Adresse und Name der abgerufenen Webseiten und Dateien, Datum und Uhrzeit des Abrufs, übertragene Datenmengen, Meldung über erfolgreichen Abruf, Browsertyp nebst Version, das Betriebssystem des Nutzers, Referrer URL (die zuvor besuchte Seite) und im Regelfall IP-Adressen und der anfragende Provider gehören.</p>
<p>Die Serverlogfiles können zum einen zu Zwecken der Sicherheit eingesetzt werden, z.B., um eine Überlastung der Server zu vermeiden (insbesondere im Fall von missbräuchlichen Angriffen, sogenannten DDoS-Attacken) und zum anderen, um die Auslastung der Server und ihre Stabilität sicherzustellen.</p>
<ul class="m-elements"><li><p><strong>Verarbeitete Datenarten:</strong> Inhaltsdaten  (z.B. Texteingaben, Fotografien, Videos), Nutzungsdaten  (z.B. besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten), Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen).</p></li><li><p><strong>Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von Onlinediensten).</p></li><li><p><strong>Rechtsgrundlagen:</strong> Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li></ul><h2 id="m29">Cloud-Dienste</h2><p>Wir nutzen über das Internet zugängliche und auf den Servern ihrer Anbieter ausgeführte Softwaredienste (sogenannte "Cloud-Dienste", auch bezeichnet als "Software as a Service") für die folgenden Zwecke: Dokumentenspeicherung und Verwaltung, Kalenderverwaltung, E-Mail-Versand, Tabellenkalkulationen und Präsentationen, Austausch von Dokumenten, Inhalten und Informationen mit bestimmten Empfängern oder Veröffentlichung von Webseiten, Formularen oder sonstigen Inhalten und Informationen sowie Chats und Teilnahme an Audio- und Videokonferenzen.</p>
<p>In diesem Rahmen können personenbezogenen Daten verarbeitet und auf den Servern der Anbieter gespeichert werden, soweit diese Bestandteil von Kommunikationsvorgängen mit uns sind oder von uns sonst, wie im Rahmen dieser Datenschutzerklärung dargelegt, verarbeitet werden. Zu diesen Daten können insbesondere Stammdaten und Kontaktdaten der Nutzer, Daten zu Vorgängen, Verträgen, sonstigen Prozessen und deren Inhalte gehören. Die Anbieter der Cloud-Dienste verarbeiten ferner Nutzungsdaten und Metadaten, die von ihnen zu Sicherheitszwecken und zur Serviceoptimierung verwendet werden.</p>
<p>Sofern wir mit Hilfe der Cloud-Dienste für andere Nutzer oder öffentlich zugängliche Webseiten Formulare o.a. Dokumente und Inhalte bereitstellen, können die Anbieter Cookies auf den Geräten der Nutzer für Zwecke der Webanalyse oder, um sich Einstellungen der Nutzer (z.B. im Fall der Mediensteuerung) zu merken, speichern.</p>
<p><strong>Hinweise zu Rechtsgrundlagen:</strong> Sofern wir um eine Einwilligung in den Einsatz der Cloud-Dienste bitten, ist die Rechtsgrundlage der Verarbeitung die Einwilligung. Ferner kann deren Einsatz ein Bestandteil unserer (vor)vertraglichen Leistungen sein, sofern der Einsatz der Cloud-Dienste in diesem Rahmen vereinbart wurde. Ansonsten werden die Daten der Nutzer auf Grundlage unserer berechtigten Interessen (d.h., Interesse an effizienten und sicheren Verwaltungs- und Kollaborationsprozessen) verarbeitet</p>
<ul class="m-elements"><li><p><strong>Verarbeitete Datenarten:</strong> Bestandsdaten (z.B. Namen, Adressen), Kontaktdaten (z.B. E-Mail, Telefonnummern), Inhaltsdaten  (z.B. Texteingaben, Fotografien, Videos), Nutzungsdaten  (z.B. besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten), Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen).</p></li><li><p><strong>Betroffene Personen:</strong> Kunden, Beschäftigte (z.B. Angestellte, Bewerber, ehemalige Mitarbeiter), Interessenten, Kommunikationspartner.</p></li><li><p><strong>Zwecke der Verarbeitung:</strong> Büro- und Organisationsverfahren.</p></li><li><p><strong>Rechtsgrundlagen:</strong> Einwilligung (Art. 6 Abs. 1 S. 1 lit. a DSGVO), Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b. DSGVO), Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li></ul><p><strong>Eingesetzte Dienste und Diensteanbieter:</strong></p><ul class="m-elements"><li><p><strong>Google Cloud-Dienste:</strong> Cloud-Speicher-Dienste; Dienstanbieter: Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland, Mutterunternehmen: Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA; Website: <a href="https://cloud.google.com/" target="_blank">https://cloud.google.com/</a>; Datenschutzerklärung: <a href="https://www.google.com/policies/privacy" target="_blank">https://www.google.com/policies/privacy</a>,  Sicherheitshinweise: <a href="https://cloud.google.com/security/privacy" target="_blank">https://cloud.google.com/security/privacy</a>; Privacy Shield (Gewährleistung Datenschutzniveau bei Verarbeitung von Daten in den USA): <a href="https://www.privacyshield.gov/participant?id=a2zt0000000000001L5AAI&status=Aktive" target="_blank">https://www.privacyshield.gov/participant?id=a2zt0000000000001L5AAI&status=Aktive</a>; Standardvertragsklauseln (Gewährleistung Datenschutzniveau bei Verarbeitung im Drittland): <a href="https://cloud.google.com/terms/data-processing-terms" target="_blank">https://cloud.google.com/terms/data-processing-terms</a>; Zusätzliche Hinweise zum Datenschutz: <a href="https://cloud.google.com/terms/data-processing-terms" target="_blank">https://cloud.google.com/terms/data-processing-terms</a>.</p></li></ul><h2 id="m17">Newsletter und Breitenkommunikation</h2><p>Wir versenden Newsletter, E-Mails und weitere elektronische Benachrichtigungen (nachfolgend "Newsletter“) nur mit der Einwilligung der Empfänger oder einer gesetzlichen Erlaubnis. Sofern im Rahmen einer Anmeldung zum Newsletter dessen Inhalte konkret umschrieben werden, sind sie für die Einwilligung der Nutzer maßgeblich. Im Übrigen enthalten unsere Newsletter Informationen zu unseren Leistungen und uns.</p>
<p>Um sich zu unseren Newslettern anzumelden, reicht es grundsätzlich aus, wenn Sie Ihre E-Mail-Adresse angeben. Wir können Sie jedoch bitten, einen Namen, zwecks persönlicher Ansprache im Newsletter, oder weitere Angaben, sofern diese für die Zwecke des Newsletters erforderlich sind, zu tätigen.</p>
<p><strong>Double-Opt-In-Verfahren:</strong> Die Anmeldung zu unserem Newsletter erfolgt grundsätzlich in einem sogenannte Double-Opt-In-Verfahren. D.h., Sie erhalten nach der Anmeldung eine E-Mail, in der Sie um die Bestätigung Ihrer Anmeldung gebeten werden. Diese Bestätigung ist notwendig, damit sich niemand mit fremden E-Mail-Adressen anmelden kann. Die Anmeldungen zum Newsletter werden protokolliert, um den Anmeldeprozess entsprechend den rechtlichen Anforderungen nachweisen zu können. Hierzu gehört die Speicherung des Anmelde- und des Bestätigungszeitpunkts als auch der IP-Adresse. Ebenso werden die Änderungen Ihrer bei dem Versanddienstleister gespeicherten Daten protokolliert.</p>
<p><strong>Löschung und Einschränkung der Verarbeitung: </strong> Wir können die ausgetragenen E-Mail-Adressen bis zu drei Jahren auf Grundlage unserer berechtigten Interessen speichern, bevor wir sie löschen, um eine ehemals gegebene Einwilligung nachweisen zu können. Die Verarbeitung dieser Daten wird auf den Zweck einer möglichen Abwehr von Ansprüchen beschränkt. Ein individueller Löschungsantrag ist jederzeit möglich, sofern zugleich das ehemalige Bestehen einer Einwilligung bestätigt wird. Im Fall von Pflichten zur dauerhaften Beachtung von Widersprüchen behalten wir uns die Speicherung der E-Mail-Adresse alleine zu diesem Zweck in einer Sperrliste (sogenannte "Blacklist") vor.</p>
<p>Die Protokollierung des Anmeldeverfahrens erfolgt auf Grundlage unserer berechtigten Interessen zu Zwecken des Nachweises seines ordnungsgemäßen Ablaufs. Soweit wir einen Dienstleister mit dem Versand von E-Mails beauftragen, erfolgt dies auf Grundlage unserer berechtigten Interessen an einem effizienten und sicheren Versandsystem.</p>
<p><strong>Hinweise zu Rechtsgrundlagen:</strong> Der Versand der Newsletter erfolgt auf Grundlage einer Einwilligung der Empfänger oder, falls eine Einwilligung nicht erforderlich ist, auf Grundlage unserer berechtigten Interessen am Direktmarketing, sofern und soweit diese gesetzlich, z.B. im Fall von Bestandskundenwerbung, erlaubt ist. Soweit wir einen Dienstleister mit dem Versand von E-Mails beauftragen, geschieht dies auf der Grundlage unserer berechtigten Interessen. Das Registrierungsverfahren wird auf der Grundlage unserer berechtigten Interessen aufgezeichnet, um nachzuweisen, dass es in Übereinstimmung mit dem Gesetz durchgeführt wurde.</p>
<p><strong>Inhalte</strong>: Informationen zu uns, unseren Leistungen, Aktionen und Angeboten.</p>
<p><strong>Erfolgsmessung</strong>: Die Newsletter enthalten einen sogenannte "web-beacon“, d.h., eine pixelgroße Datei, die beim Öffnen des Newsletters von unserem Server, bzw., sofern wir einen Versanddienstleister einsetzen, von dessen Server abgerufen wird. Im Rahmen dieses Abrufs werden zunächst technische Informationen, wie Informationen zum Browser und Ihrem System, als auch Ihre IP-Adresse und der Zeitpunkt des Abrufs, erhoben. </p>
<p>Diese Informationen werden zur technischen Verbesserung unseres Newsletters anhand der technischen Daten oder der Zielgruppen und ihres Leseverhaltens auf Basis ihrer Abruforte (die mit Hilfe der IP-Adresse bestimmbar sind) oder der Zugriffszeiten genutzt. Diese Analyse beinhaltet ebenfalls die Feststellung, ob die Newsletter geöffnet werden, wann sie geöffnet werden und welche Links geklickt werden. Diese Informationen können aus technischen Gründen zwar den einzelnen Newsletterempfängern zugeordnet werden. Es ist jedoch weder unser Bestreben noch, sofern eingesetzt, das des Versanddienstleisters, einzelne Nutzer zu beobachten. Die Auswertungen dienen uns vielmehr dazu, die Lesegewohnheiten unserer Nutzer zu erkennen und unsere Inhalte an sie anzupassen oder unterschiedliche Inhalte entsprechend den Interessen unserer Nutzer zu versenden.</p>
<p>Die Auswertung des Newsletters und die Erfolgsmessung erfolgen, vorbehaltlich einer ausdrücklichen Einwilligung der Nutzer, auf Grundlage unserer berechtigten Interessen zu Zwecken des Einsatzes eines nutzerfreundlichen sowie sicheren Newslettersystems, welches sowohl unseren geschäftlichen Interessen dient, als auch den Erwartungen der Nutzer entspricht.</p>
<p>Ein getrennter Widerruf der Erfolgsmessung ist leider nicht möglich, in diesem Fall muss das gesamte Newsletterabonnement gekündigt, bzw. muss ihm widersprochen werden.</p>
<p><strong>Voraussetzung der Inanspruchnahme kostenloser Leistungen</strong>: Die Einwilligungen in den Versand von Mailings kann als Voraussetzung zur Inanspruchnahme kostenloser Leistungen (z.B. Zugang zu bestimmten Inhalten oder Teilnahme an bestimmten Aktionen) abhängig gemacht werden. Sofern die Nutzer die kostenlose Leistung in Anspruch nehmen möchten, ohne sich zum Newsletter anzumelden, bitten wir Sie um eine Kontaktaufnahme.</p>
<ul class="m-elements"><li><p><strong>Verarbeitete Datenarten:</strong> Bestandsdaten (z.B. Namen, Adressen), Kontaktdaten (z.B. E-Mail, Telefonnummern), Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen), Nutzungsdaten  (z.B. besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten).</p></li><li><p><strong>Betroffene Personen:</strong> Kommunikationspartner, Nutzer (z.B. Webseitenbesucher, Nutzer von Onlinediensten).</p></li><li><p><strong>Zwecke der Verarbeitung:</strong> Direktmarketing (z.B. per E-Mail oder postalisch), Vertragliche Leistungen und Service.</p></li><li><p><strong>Rechtsgrundlagen:</strong> Einwilligung (Art. 6 Abs. 1 S. 1 lit. a DSGVO), Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li><li><p><strong>Widerspruchsmöglichkeit (Opt-Out):</strong> Sie können den Empfang unseres Newsletters jederzeit kündigen, d.h. Ihre Einwilligungen widerrufen, bzw. dem weiteren Empfang widersprechen. Einen Link zur Kündigung des Newsletters finden Sie entweder am Ende eines jeden Newsletters oder können sonst eine der oben angegebenen Kontaktmöglichkeiten, vorzugswürdig E-Mail, hierzu nutzen.</p></li></ul><h2 id="m263">Webanalyse und Optimierung</h2><p>Die Webanalyse (auch als "Reichweitenmessung" bezeichnet) dient der Auswertung der Besucherströme unseres Onlineangebotes und kann Verhalten, Interessen oder demographische Informationen zu den Besuchern, wie z.B. das Alter oder das Geschlecht, als pseudonyme Werte umfassen. Mit Hilfe der Reichweitenanalyse können wir z.B. erkennen, zu welcher Zeit unser Onlineangebot oder dessen Funktionen oder Inhalte am häufigsten genutzt werden oder zur Wiederverwendung einladen. Ebenso können wir nachvollziehen, welche Bereiche der Optimierung bedürfen. </p>
<p>Neben der Webanalyse können wir auch Testverfahren einsetzen, um z.B. unterschiedliche Versionen unseres Onlineangebotes oder seiner Bestandteile zu testen und optimieren.</p>
<p>Zu diesen Zwecken können sogenannte Nutzerprofile angelegt und in einer Datei (sogenannte "Cookie") gespeichert oder ähnliche Verfahren mit dem gleichen Zweck genutzt werden. Zu diesen Angaben können z.B. betrachtete Inhalte, besuchte Webseiten und dort genutzte Elemente und technische Angaben, wie der verwendete Browser, das verwendete Computersystem sowie Angaben zu Nutzungszeiten gehören. Sofern Nutzer in die Erhebung ihrer Standortdaten eingewilligt haben, können je nach Anbieter auch diese verarbeitet werden.</p>
<p>Es werden ebenfalls die IP-Adressen der Nutzer gespeichert. Jedoch nutzen wir ein IP-Masking-Verfahren (d.h., Pseudonymisierung durch Kürzung der IP-Adresse) zum Schutz der Nutzer. Generell werden die im Rahmen von Webanalyse, A/B-Testings und Optimierung keine Klardaten der Nutzer (wie z.B. E-Mail-Adressen oder Namen) gespeichert, sondern Pseudonyme. D.h., wir als auch die Anbieter der eingesetzten Software kennen nicht die tatsächliche Identität der Nutzer, sondern nur den für Zwecke der jeweiligen Verfahren in deren Profilen gespeicherten Angaben.</p>
<p><strong>Hinweise zu Rechtsgrundlagen:</strong> Sofern wir die Nutzer um deren Einwilligung in den Einsatz der Drittanbieter bitten, ist die Rechtsgrundlage der Verarbeitung von Daten die Einwilligung. Ansonsten werden die Daten der Nutzer auf Grundlage unserer berechtigten Interessen (d.h. Interesse an effizienten, wirtschaftlichen und empfängerfreundlichen Leistungen) verarbeitet. In diesem Zusammenhang möchten wir Sie auch auf die Informationen zur Verwendung von Cookies in dieser Datenschutzerklärung hinweisen.</p>
<ul class="m-elements"><li><p><strong>Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von Onlinediensten).</p></li><li><p><strong>Zwecke der Verarbeitung:</strong> Reichweitenmessung (z.B. Zugriffsstatistiken, Erkennung wiederkehrender Besucher), Tracking (z.B. interessens-/verhaltensbezogenes Profiling, Nutzung von Cookies), Besuchsaktionsauswertung, Profiling (Erstellen von Nutzerprofilen).</p></li><li><p><strong>Sicherheitsmaßnahmen:</strong> IP-Masking (Pseudonymisierung der IP-Adresse).</p></li><li><p><strong>Rechtsgrundlagen:</strong> Einwilligung (Art. 6 Abs. 1 S. 1 lit. a DSGVO), Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li></ul><h2 id="m264">Onlinemarketing</h2><p>Wir verarbeiten personenbezogene Daten zu Zwecken des Onlinemarketings, worunter insbesondere die Darstellung von werbenden und sonstigen Inhalten (zusammenfassend als "Inhalte" bezeichnet) anhand potentieller Interessen der Nutzer sowie die Messung ihrer Effektivität fallen. </p>
<p>Zu diesen Zwecken werden sogenannte Nutzerprofile angelegt und in einer Datei (sogenannte "Cookie") gespeichert oder ähnliche Verfahren genutzt, mittels derer die für die Darstellung der vorgenannten Inhalte relevante Angaben zum Nutzer gespeichert werden. Zu diesen Angaben können z.B. betrachtete Inhalte, besuchte Webseiten, genutzte Onlinenetzwerke, aber auch Kommunikationspartner und technische Angaben, wie der verwendete Browser, das verwendete Computersystem sowie Angaben zu Nutzungszeiten gehören. Sofern Nutzer in die Erhebung ihrer Standortdaten eingewilligt haben, können auch diese verarbeitet werden.</p>
<p>Es werden ebenfalls die IP-Adressen der Nutzer gespeichert. Jedoch nutzen wir IP-Masking-Verfahren (d.h., Pseudonymisierung durch Kürzung der IP-Adresse) zum Schutz der Nutzer. Generell werden im Rahmen des Onlinemarketingverfahren keine Klardaten der Nutzer (wie z.B. E-Mail-Adressen oder Namen) gespeichert, sondern Pseudonyme. D.h., wir als auch die Anbieter der Onlinemarketingverfahren kennen nicht die tatsächlich Identität der Nutzer, sondern nur die in deren Profilen gespeicherten Angaben.</p>
<p>Die Angaben in den Profilen werden im Regelfall in den Cookies oder mittels ähnlicher Verfahren gespeichert. Diese Cookies können später generell auch auf anderen Webseiten die dasselbe Onlinemarketingverfahren einsetzen, ausgelesen und zu Zwecken der Darstellung von Inhalten analysiert als auch mit weiteren Daten ergänzt und auf dem Server des Onlinemarketingverfahrensanbieters gespeichert werden.</p>
<p>Ausnahmsweise können Klardaten den Profilen zugeordnet werden. Das ist der Fall, wenn die Nutzer z.B. Mitglieder eines sozialen Netzwerks sind, dessen Onlinemarketingverfahren wir einsetzen und das Netzwerk die Profile der Nutzer im den vorgenannten Angaben verbindet. Wir bitten darum, zu beachten, dass Nutzer mit den Anbietern zusätzliche Abreden, z.B. durch Einwilligung im Rahmen der Registrierung, treffen können.</p>
<p>Wir erhalten grundsätzlich nur Zugang zu zusammengefassten Informationen über den Erfolg unserer Werbeanzeigen. Jedoch können wir im Rahmen sogenannter Konversionsmessungen prüfen, welche unserer Onlinemarketingverfahren zu einer sogenannten Konversion geführt haben, d.h. z.B., zu einem Vertragsschluss mit uns. Die Konversionsmessung wird alleine zur Analyse des Erfolgs unserer Marketingmaßnahmen verwendet.</p>
<p><strong>Hinweise zu Rechtsgrundlagen:</strong> Sofern wir die Nutzer um deren Einwilligung in den Einsatz der Drittanbieter bitten, ist die Rechtsgrundlage der Verarbeitung von Daten die Einwilligung. Ansonsten werden die Daten der Nutzer auf Grundlage unserer berechtigten Interessen (d.h. Interesse an effizienten, wirtschaftlichen und empfängerfreundlichen Leistungen) verarbeitet. In diesem Zusammenhang möchten wir Sie auch auf die Informationen zur Verwendung von Cookies in dieser Datenschutzerklärung hinweisen.</p>
<p><strong>Facebook-Pixel</strong>: Mit Hilfe des Facebook-Pixels ist es Facebook zum einen möglich, die Besucher unseres Onlineangebotes als Zielgruppe für die Darstellung von Anzeigen (sogenannte "Facebook-Ads") zu bestimmen. Dementsprechend setzen wir das Facebook-Pixel ein, um die durch uns geschalteten Facebook-Ads nur solchen Facebook-Nutzern anzuzeigen, die auch ein Interesse an unserem Onlineangebot gezeigt haben oder die bestimmte Merkmale (z.B. Interesse an bestimmten Themen oder Produkten, die anhand der besuchten Webseiten ersichtlich werden) aufweisen, die wir an Facebook übermitteln (sogenannte "Custom Audiences“). Mit Hilfe des Facebook-Pixels möchten wir auch sicherstellen, dass unsere Facebook-Ads dem potentiellen Interesse der Nutzer entsprechen und nicht belästigend wirken. Mit Hilfe des Facebook-Pixels können wir ferner die Wirksamkeit der Facebook-Werbeanzeigen für statistische und Marktforschungszwecke nachvollziehen, indem wir sehen, ob Nutzer nach dem Klick auf eine Facebook-Werbeanzeige auf unsere Webseite weitergeleitet wurden (sogenannte "Konversionsmessung“).</p>
<ul class="m-elements"><li><p><strong>Verarbeitete Datenarten:</strong> Nutzungsdaten  (z.B. besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten), Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen), Standortdaten (Daten, die den Standort des Endgeräts eines Endnutzers angeben).</p></li><li><p><strong>Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von Onlinediensten), Interessenten.</p></li><li><p><strong>Zwecke der Verarbeitung:</strong> Tracking (z.B. interessens-/verhaltensbezogenes Profiling, Nutzung von Cookies), Remarketing, Besuchsaktionsauswertung, Interessenbasiertes und verhaltensbezogenes Marketing, Profiling (Erstellen von Nutzerprofilen), Konversionsmessung (Messung der Effektivität von Marketingmaßnahmen), Reichweitenmessung (z.B. Zugriffsstatistiken, Erkennung wiederkehrender Besucher), Zielgruppenbildung (Bestimmung von für Marketingzwecke relevanten Zielgruppen oder sonstige Ausgabe von Inhalten), Cross-Device Tracking (geräteübergreifende Verarbeitung von Nutzerdaten für Marketingzwecke).</p></li><li><p><strong>Sicherheitsmaßnahmen:</strong> IP-Masking (Pseudonymisierung der IP-Adresse).</p></li><li><p><strong>Rechtsgrundlagen:</strong> Einwilligung (Art. 6 Abs. 1 S. 1 lit. a DSGVO), Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li><li><p><strong>Widerspruchsmöglichkeit (Opt-Out):</strong> Wir verweisen auf die Datenschutzhinweise der jeweiligen Anbieter und die zu den Anbietern angegebenen Widerspruchsmöglichkeiten (sog. \"Opt-Out\"). Sofern keine explizite Opt-Out-Möglichkeit angegeben wurde, besteht zum einen die Möglichkeit, dass Sie Cookies in den Einstellungen Ihres Browsers abschalten. Hierdurch können jedoch Funktionen unseres Onlineangebotes eingeschränkt werden. Wir empfehlen daher zusätzlich die folgenden Opt-Out-Möglichkeiten, die zusammenfassend auf jeweilige Gebiete gerichtet angeboten werden:

a) Europa: <a href="https://www.youronlinechoices.eu" target="_blank">https://www.youronlinechoices.eu</a>.  
b) Kanada: <a href="https://www.youradchoices.ca/choices" target="_blank">https://www.youradchoices.ca/choices</a>. 
c) USA: <a href="https://www.aboutads.info/choices" target="_blank">https://www.aboutads.info/choices</a>. 
d) Gebietsübergreifend: <a href="http://optout.aboutads.info" target="_blank">http://optout.aboutads.info</a>.</p></li></ul><p><strong>Eingesetzte Dienste und Diensteanbieter:</strong></p><ul class="m-elements"><li><p><strong>Google Tag Manager:</strong> Google Tag Manager ist eine Lösung, mit der wir sog. Website-Tags über eine Oberfläche verwalten können (und so z.B. Google Analytics sowie andere Google-Marketing-Dienste in unser Onlineangebot einbinden). Der Tag Manager selbst (welches die Tags implementiert) verarbeitet keine personenbezogenen Daten der Nutzer. Im Hinblick auf die Verarbeitung der personenbezogenen Daten der Nutzer wird auf die folgenden Angaben zu den Google-Diensten verwiesen. Dienstanbieter: Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland, Mutterunternehmen: Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA; Website: <a href="https://marketingplatform.google.com" target="_blank">https://marketingplatform.google.com</a>; Datenschutzerklärung: <a href="https://policies.google.com/privacy" target="_blank">https://policies.google.com/privacy</a>; Privacy Shield (Gewährleistung Datenschutzniveau bei Verarbeitung von Daten in den USA): <a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&status=Active" target="_blank">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&status=Active</a>.</p></li> <li><p><strong>Google Analytics:</strong> Onlinemarketing und Webanalyse; Dienstanbieter: Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland, Mutterunternehmen: Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA; Website: <a href="https://marketingplatform.google.com/intl/de/about/analytics/" target="_blank">https://marketingplatform.google.com/intl/de/about/analytics/</a>; Datenschutzerklärung: <a href="https://policies.google.com/privacy" target="_blank">https://policies.google.com/privacy</a>; Privacy Shield (Gewährleistung Datenschutzniveau bei Verarbeitung von Daten in den USA): <a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&status=Active" target="_blank">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&status=Active</a>; Widerspruchsmöglichkeit (Opt-Out): Opt-Out-Plugin: <a href="http://tools.google.com/dlpage/gaoptout?hl=de" target="_blank">http://tools.google.com/dlpage/gaoptout?hl=de</a>,  Einstellungen für die Darstellung von Werbeeinblendungen: <a href="https://adssettings.google.com/authenticated" target="_blank">https://adssettings.google.com/authenticated</a>.</p></li> <li><p><strong>Facebook-Pixel:</strong> Facebook-Pixel; Dienstanbieter: <a href="https://www.facebook.com" target="_blank">https://www.facebook.com</a>, Facebook Ireland Ltd., 4 Grand Canal Square, Grand Canal Harbour, Dublin 2, Irland, Mutterunternehmen: Facebook, 1 Hacker Way, Menlo Park, CA 94025, USA; Website: <a href="https://www.facebook.com" target="_blank">https://www.facebook.com</a>; Datenschutzerklärung: <a href="https://www.facebook.com/about/privacy" target="_blank">https://www.facebook.com/about/privacy</a>; Privacy Shield (Gewährleistung Datenschutzniveau bei Verarbeitung von Daten in den USA): <a href="https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active" target="_blank">https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active</a>; Widerspruchsmöglichkeit (Opt-Out): <a href="https://www.facebook.com/settings?tab=ads" target="_blank">https://www.facebook.com/settings?tab=ads</a>.</p></li></ul><h2 id="m136">Präsenzen in sozialen Netzwerken</h2><p>Wir unterhalten Onlinepräsenzen innerhalb sozialer Netzwerke, um mit den dort aktiven Nutzern zu kommunizieren oder um dort Informationen über uns anzubieten.</p>
<p>Wir weisen darauf hin, dass dabei Daten der Nutzer außerhalb des Raumes der Europäischen Union verarbeitet werden können. Hierdurch können sich für die Nutzer Risiken ergeben, weil so z.B. die Durchsetzung der Rechte der Nutzer erschwert werden könnte. Im Hinblick auf US-Anbieter, die unter dem Privacy-Shield zertifiziert sind oder vergleichbare Garantien eines sicheren Datenschutzniveaus bieten, weisen wir darauf hin, dass sie sich damit verpflichten, die Datenschutzstandards der EU einzuhalten.</p>
<p>Ferner werden die Daten der Nutzer innerhalb sozialer Netzwerke im Regelfall für Marktforschungs- und Werbezwecke verarbeitet. So können z.B. anhand des Nutzungsverhaltens und sich daraus ergebender Interessen der Nutzer Nutzungsprofile erstellt werden. Die Nutzungsprofile können wiederum verwendet werden, um z.B. Werbeanzeigen innerhalb und außerhalb der Netzwerke zu schalten, die mutmaßlich den Interessen der Nutzer entsprechen. Zu diesen Zwecken werden im Regelfall Cookies auf den Rechnern der Nutzer gespeichert, in denen das Nutzungsverhalten und die Interessen der Nutzer gespeichert werden. Ferner können in den Nutzungsprofilen auch Daten unabhängig der von den Nutzern verwendeten Geräte gespeichert werden (insbesondere, wenn die Nutzer Mitglieder der jeweiligen Plattformen sind und bei diesen eingeloggt sind).</p>
<p>Für eine detaillierte Darstellung der jeweiligen Verarbeitungsformen und der Widerspruchsmöglichkeiten (Opt-Out) verweisen wir auf die Datenschutzerklärungen und Angaben der Betreiber der jeweiligen Netzwerke.</p>
<p>Auch im Fall von Auskunftsanfragen und der Geltendmachung von Betroffenenrechten weisen wir darauf hin, dass diese am effektivsten bei den Anbietern geltend gemacht werden können. Nur die Anbieter haben jeweils Zugriff auf die Daten der Nutzer und können direkt entsprechende Maßnahmen ergreifen und Auskünfte geben. Sollten Sie dennoch Hilfe benötigen, dann können Sie sich an uns wenden.</p>
<ul class="m-elements"><li><p><strong>Verarbeitete Datenarten:</strong> Bestandsdaten (z.B. Namen, Adressen), Kontaktdaten (z.B. E-Mail, Telefonnummern), Inhaltsdaten  (z.B. Texteingaben, Fotografien, Videos), Nutzungsdaten  (z.B. besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten), Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen).</p></li><li><p><strong>Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von Onlinediensten).</p></li><li><p><strong>Zwecke der Verarbeitung:</strong> Kontaktanfragen und Kommunikation, Tracking (z.B. interessens-/verhaltensbezogenes Profiling, Nutzung von Cookies), Remarketing, Reichweitenmessung (z.B. Zugriffsstatistiken, Erkennung wiederkehrender Besucher).</p></li><li><p><strong>Rechtsgrundlagen:</strong> Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li></ul><p><strong>Eingesetzte Dienste und Diensteanbieter:</strong></p><ul class="m-elements"><li><p><strong>Instagram :</strong> Soziales Netzwerk; Dienstanbieter: Instagram Inc., 1601 Willow Road, Menlo Park, CA, 94025, USA; Website: <a href="https://www.instagram.com" target="_blank">https://www.instagram.com</a>; Datenschutzerklärung: <a href="http://instagram.com/about/legal/privacy" target="_blank">http://instagram.com/about/legal/privacy</a>.</p></li> <li><p><strong>Facebook:</strong> Soziales Netzwerk; Dienstanbieter: Facebook Ireland Ltd., 4 Grand Canal Square, Grand Canal Harbour, Dublin 2, Irland, Mutterunternehmen: Facebook, 1 Hacker Way, Menlo Park, CA 94025, USA; Website: <a href="https://www.facebook.com" target="_blank">https://www.facebook.com</a>; Datenschutzerklärung: <a href="https://www.facebook.com/about/privacy" target="_blank">https://www.facebook.com/about/privacy</a>; Privacy Shield (Gewährleistung Datenschutzniveau bei Verarbeitung von Daten in den USA): <a href="https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active" target="_blank">https://www.privacyshield.gov/participant?id=a2zt0000000GnywAAC&status=Active</a>; Widerspruchsmöglichkeit (Opt-Out): Einstellungen für Werbeanzeigen: <a href="https://www.facebook.com/settings?tab=ads" target="_blank">https://www.facebook.com/settings?tab=ads</a>; Zusätzliche Hinweise zum Datenschutz: Vereinbarung über gemeinsame Verarbeitung personenbezogener Daten auf Facebook-Seiten: <a href="https://www.facebook.com/legal/terms/page_controller_addendum" target="_blank">https://www.facebook.com/legal/terms/page_controller_addendum</a>, Datenschutzhinweise für Facebook-Seiten: <a href="https://www.facebook.com/legal/terms/information_about_page_insights_data" target="_blank">https://www.facebook.com/legal/terms/information_about_page_insights_data</a>.</p></li> <li><p><strong>YouTube:</strong> Soziales Netzwerk; Dienstanbieter: Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland, Mutterunternehmen: Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA; Datenschutzerklärung: <a href="https://policies.google.com/privacy" target="_blank">https://policies.google.com/privacy</a>; Privacy Shield (Gewährleistung Datenschutzniveau bei Verarbeitung von Daten in den USA): <a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&status=Active" target="_blank">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&status=Active</a>; Widerspruchsmöglichkeit (Opt-Out): <a href="https://adssettings.google.com/authenticated" target="_blank">https://adssettings.google.com/authenticated</a>.</p></li></ul><h2 id="m328">Plugins und eingebettete Funktionen sowie Inhalte</h2><p>Wir binden in unser Onlineangebot Funktions- und Inhaltselemente ein, die von den Servern ihrer jeweiligen Anbieter (nachfolgend bezeichnet als "Drittanbieter”) bezogen werden. Dabei kann es sich zum Beispiel um Grafiken, Videos oder Social-Media-Schaltflächen sowie Beiträge handeln (nachfolgend einheitlich bezeichnet als "Inhalte”).</p>
<p>Die Einbindung setzt immer voraus, dass die Drittanbieter dieser Inhalte die IP-Adresse der Nutzer verarbeiten, da sie ohne die IP-Adresse die Inhalte nicht an deren Browser senden könnten. Die IP-Adresse ist damit für die Darstellung dieser Inhalte oder Funktionen erforderlich. Wir bemühen uns, nur solche Inhalte zu verwenden, deren jeweilige Anbieter die IP-Adresse lediglich zur Auslieferung der Inhalte verwenden. Drittanbieter können ferner sogenannte Pixel-Tags (unsichtbare Grafiken, auch als "Web Beacons" bezeichnet) für statistische oder Marketingzwecke verwenden. Durch die "Pixel-Tags" können Informationen, wie der Besucherverkehr auf den Seiten dieser Webseite, ausgewertet werden. Die pseudonymen Informationen können ferner in Cookies auf dem Gerät der Nutzer gespeichert werden und unter anderem technische Informationen zum Browser und zum Betriebssystem, zu verweisenden Webseiten, zur Besuchszeit sowie weitere Angaben zur Nutzung unseres Onlineangebotes enthalten als auch mit solchen Informationen aus anderen Quellen verbunden werden.</p>
<p><strong>Hinweise zu Rechtsgrundlagen:</strong> Sofern wir die Nutzer um deren Einwilligung in den Einsatz der Drittanbieter bitten, ist die Rechtsgrundlage der Verarbeitung von Daten die Einwilligung. Ansonsten werden die Daten der Nutzer auf Grundlage unserer berechtigten Interessen (d.h. Interesse an effizienten, wirtschaftlichen und empfängerfreundlichen Leistungen) verarbeitet. In diesem Zusammenhang möchten wir Sie auch auf die Informationen zur Verwendung von Cookies in dieser Datenschutzerklärung hinweisen.</p>
<ul class="m-elements"><li><p><strong>Verarbeitete Datenarten:</strong> Nutzungsdaten  (z.B. besuchte Webseiten, Interesse an Inhalten, Zugriffszeiten), Meta-/Kommunikationsdaten (z.B. Geräte-Informationen, IP-Adressen), Bestandsdaten (z.B. Namen, Adressen), Kontaktdaten (z.B. E-Mail, Telefonnummern), Inhaltsdaten  (z.B. Texteingaben, Fotografien, Videos).</p></li><li><p><strong>Betroffene Personen:</strong> Nutzer (z.B. Webseitenbesucher, Nutzer von Onlinediensten).</p></li><li><p><strong>Zwecke der Verarbeitung:</strong> Bereitstellung unseres Onlineangebotes und Nutzerfreundlichkeit, Vertragliche Leistungen und Service, Sicherheitsmaßnahmen, Verwaltung und Beantwortung von Anfragen.</p></li><li><p><strong>Rechtsgrundlagen:</strong> Einwilligung (Art. 6 Abs. 1 S. 1 lit. a DSGVO), Vertragserfüllung und vorvertragliche Anfragen (Art. 6 Abs. 1 S. 1 lit. b. DSGVO), Berechtigte Interessen (Art. 6 Abs. 1 S. 1 lit. f. DSGVO).</p></li></ul><p><strong>Eingesetzte Dienste und Diensteanbieter:</strong></p><ul class="m-elements"><li><p><strong>YouTube:</strong> Videos; Dienstanbieter: Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Irland, Mutterunternehmen: Google LLC, 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA; Website: <a href="https://www.youtube.com" target="_blank">https://www.youtube.com</a>; Datenschutzerklärung: <a href="https://policies.google.com/privacy" target="_blank">https://policies.google.com/privacy</a>; Privacy Shield (Gewährleistung Datenschutzniveau bei Verarbeitung von Daten in den USA): <a href="https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&status=Active" target="_blank">https://www.privacyshield.gov/participant?id=a2zt000000001L5AAI&status=Active</a>; Widerspruchsmöglichkeit (Opt-Out): Opt-Out-Plugin: <a href="http://tools.google.com/dlpage/gaoptout?hl=de" target="_blank">http://tools.google.com/dlpage/gaoptout?hl=de</a>,  Einstellungen für die Darstellung von Werbeeinblendungen: <a href="https://adssettings.google.com/authenticated" target="_blank">https://adssettings.google.com/authenticated</a>.</p></li></ul><h2 id="m12">Löschung von Daten</h2><p>Die von uns verarbeiteten Daten werden nach Maßgabe der gesetzlichen Vorgaben gelöscht, sobald deren zur Verarbeitung erlaubten Einwilligungen widerrufen werden oder sonstige Erlaubnisse entfallen (z.B., wenn der Zweck der Verarbeitung dieser Daten entfallen ist oder sie für den Zweck nicht erforderlich sind).</p>
<p>Sofern die Daten nicht gelöscht werden, weil sie für andere und gesetzlich zulässige Zwecke erforderlich sind, wird deren Verarbeitung auf diese Zwecke beschränkt. D.h., die Daten werden gesperrt und nicht für andere Zwecke verarbeitet. Das gilt z.B. für Daten, die aus handels- oder steuerrechtlichen Gründen aufbewahrt werden müssen oder deren Speicherung zur Geltendmachung, Ausübung oder Verteidigung von Rechtsansprüchen oder zum Schutz der Rechte einer anderen natürlichen oder juristischen Person erforderlich ist.</p>
<p>Weitere Hinweise zu der Löschung von personenbezogenen Daten können ferner im Rahmen der einzelnen Datenschutzhinweise dieser Datenschutzerklärung erfolgen.</p>
<ul class="m-elements"></ul><h2 id="m15">Änderung und Aktualisierung der Datenschutzerklärung</h2><p>Wir bitten Sie, sich regelmäßig über den Inhalt unserer Datenschutzerklärung zu informieren. Wir passen die Datenschutzerklärung an, sobald die Änderungen der von uns durchgeführten Datenverarbeitungen dies erforderlich machen. Wir informieren Sie, sobald durch die Änderungen eine Mitwirkungshandlung Ihrerseits (z.B. Einwilligung) oder eine sonstige individuelle Benachrichtigung erforderlich wird.</p>
<h2 id="m10">Rechte der betroffenen Personen</h2><p>Ihnen stehen als Betroffene nach der DSGVO verschiedene Rechte zu, die sich insbesondere aus Art. 15 bis 18 und 21 DS-GVO ergeben:</p><ul><li><strong>Widerspruchsrecht: Sie haben das Recht, aus Gründen, die sich aus Ihrer besonderen Situation ergeben, jederzeit gegen die Verarbeitung der Sie betreffenden personenbezogenen Daten, die aufgrund von Art. 6 Abs. 1 lit. e oder f DSGVO erfolgt, Widerspruch einzulegen; dies gilt auch für ein auf diese Bestimmungen gestütztes Profiling. Werden die Sie betreffenden personenbezogenen Daten verarbeitet, um Direktwerbung zu betreiben, haben Sie das Recht, jederzeit Widerspruch gegen die Verarbeitung der Sie betreffenden personenbezogenen Daten zum Zwecke derartiger Werbung einzulegen; dies gilt auch für das Profiling, soweit es mit solcher Direktwerbung in Verbindung steht.</strong></li><li><strong>Widerrufsrecht bei Einwilligungen:</strong> Sie haben das Recht, erteilte Einwilligungen jederzeit zu widerrufen.</li><li><strong>Auskunftsrecht:</strong> Sie haben das Recht, eine Bestätigung darüber zu verlangen, ob betreffende Daten verarbeitet werden und auf Auskunft über diese Daten sowie auf weitere Informationen und Kopie der Daten entsprechend den gesetzlichen Vorgaben.</li><li><strong>Recht auf Berichtigung:</strong> Sie haben entsprechend den gesetzlichen Vorgaben das Recht, die Vervollständigung der Sie betreffenden Daten oder die Berichtigung der Sie betreffenden unrichtigen Daten zu verlangen.</li><li><strong>Recht auf Löschung und Einschränkung der Verarbeitung:</strong> Sie haben nach Maßgabe der gesetzlichen Vorgaben das Recht, zu verlangen, dass Sie betreffende Daten unverzüglich gelöscht werden, bzw. alternativ nach Maßgabe der gesetzlichen Vorgaben eine Einschränkung der Verarbeitung der Daten zu verlangen.</li><li><strong>Recht auf Datenübertragbarkeit:</strong> Sie haben das Recht, Sie betreffende Daten, die Sie uns bereitgestellt haben, nach Maßgabe der gesetzlichen Vorgaben in einem strukturierten, gängigen und maschinenlesbaren Format zu erhalten oder deren Übermittlung an einen anderen Verantwortlichen zu fordern.</li><li><strong>Beschwerde bei Aufsichtsbehörde:</strong> Sie haben ferner nach Maßgabe der gesetzlichen Vorgaben das Recht,  bei einer Aufsichtsbehörde, insbesondere in dem Mitgliedstaat Ihres gewöhnlichen Aufenthaltsorts, Ihres Arbeitsplatzes oder des Orts des mutmaßlichen Verstoßes, wenn Sie der Ansicht sind, dass die Verarbeitung der Sie betreffenden personenbezogenen Daten gegen die DSGVO verstößt.</li></ul>
<h2 id="m42">Begriffsdefinitionen</h2><p>In diesem Abschnitt erhalten Sie eine Übersicht über die in dieser Datenschutzerklärung verwendeten Begrifflichkeiten. Viele der Begriffe sind dem Gesetz entnommen und vor allem im Art. 4 DSGVO definiert. Die gesetzlichen Definitionen sind verbindlich. Die nachfolgenden Erläuterungen sollen dagegen vor allem dem Verständnis dienen. Die Begriffe sind alphabetisch sortiert.</p>
 <ul class="glossary"><li><strong>Besuchsaktionsauswertung:</strong> "Besuchsaktionsauswertung" (englisch "Conversion Tracking") bezeichnet ein Verfahren, mit dem die Wirksamkeit von Marketingmaßnahmen festgestellt werden kann. Dazu wird im Regelfall ein Cookie auf den Geräten der Nutzer innerhalb der Webseiten, auf denen die Marketingmaßnahmen erfolgen, gespeichert und dann erneut auf der Zielwebseite abgerufen. Beispielsweise können wir so nachvollziehen, ob die von uns auf anderen Webseiten geschalteten Anzeigen erfolgreich waren). </li><li><strong>Cross-Device Tracking:</strong> Das Cross-Device Tracking ist eine Form des Trackings, bei der Verhaltens- und Interessensinformationen der Nutzer geräteübergreifend in sogenannten Profilen erfasst werden, indem den Nutzern eine Onlinekennung zugeordnet wird. Hierdurch können die Nutzerinformationen unabhängig von verwendeten Browsern oder Geräten (z.B. Mobiltelefonen oder Desktopcomputern) im Regelfall für Marketingzwecke analysiert werden. Die Onlinekennung ist bei den meisten Anbietern nicht mit Klardaten, wie Namen, Postadressen oder E-Mail-Adressen, verknüpft. </li><li><strong>IP-Masking:</strong> Als "IP-Masking” wird eine Methode bezeichnet, bei der das letzte Oktett, d.h., die letzten beiden Zahlen einer IP-Adresse, gelöscht wird, damit die IP-Adresse nicht mehr der eindeutigen Identifizierung einer Person dienen kann. Daher ist das IP-Masking ein Mittel zur Pseudonymisierung von Verarbeitungsverfahren, insbesondere im Onlinemarketing </li><li><strong>Interessenbasiertes und verhaltensbezogenes Marketing:</strong> Von interessens- und/oder verhaltensbezogenem Marketing spricht man, wenn potentielle Interessen von Nutzern an Anzeigen und sonstigen Inhalten möglichst genau vorbestimmt werden. Dies geschieht anhand von Angaben zu deren Vorverhalten (z.B. Aufsuchen von bestimmten Webseiten und Verweilen auf diesen, Kaufverhaltens oder Interaktion mit anderen Nutzern), die in einem sogenannten Profil gespeichert werden. Zu diesen Zwecken werden im Regelfall Cookies eingesetzt. </li><li><strong>Konversionsmessung:</strong> Die Konversionsmessung ist ein Verfahren, mit dem die Wirksamkeit von Marketingmaßnahmen festgestellt werden kann. Dazu wird im Regelfall ein Cookie auf den Geräten der Nutzer innerhalb der Webseiten, auf denen die Marketingmaßnahmen erfolgen, gespeichert und dann erneut auf der Zielwebseite abgerufen. Beispielsweise können wir so nachvollziehen, ob die von uns auf anderen Webseiten geschalteten Anzeigen erfolgreich waren. </li><li><strong>Personenbezogene Daten:</strong> "Personenbezogene Daten“ sind alle Informationen, die sich auf eine identifizierte oder identifizierbare natürliche Person (im Folgenden "betroffene Person“) beziehen; als identifizierbar wird eine natürliche Person angesehen, die direkt oder indirekt, insbesondere mittels Zuordnung zu einer Kennung wie einem Namen, zu einer Kennnummer, zu Standortdaten, zu einer Online-Kennung (z.B. Cookie) oder zu einem oder mehreren besonderen Merkmalen identifiziert werden kann, die Ausdruck der physischen, physiologischen, genetischen, psychischen, wirtschaftlichen, kulturellen oder sozialen Identität dieser natürlichen Person sind. </li><li><strong>Profiling:</strong> Als "Profiling“ wird jede Art der automatisierten Verarbeitung personenbezogener Daten bezeichnet, die darin besteht, dass diese personenbezogenen Daten verwendet werden, um bestimmte persönliche Aspekte, die sich auf eine natürliche Person beziehen (je nach Art des Profilings gehören dazu Informationen betreffend das Alter, das Geschlecht, Standortdaten und Bewegungsdaten, Interaktion mit Webseiten und deren Inhalten, Einkaufsverhalten, soziale Interaktionen mit anderen Menschen) zu analysieren, zu bewerten oder, um sie vorherzusagen (z.B. die Interessen an bestimmten Inhalten oder Produkten, das Klickverhalten auf einer Webseite oder den Aufenthaltsort). Zu Zwecken des Profilings werden häufig Cookies und Web-Beacons eingesetzt. </li><li><strong>Reichweitenmessung:</strong> Die Reichweitenmessung (auch als Web Analytics bezeichnet) dient der Auswertung der Besucherströme eines Onlineangebotes und kann das Verhalten oder Interessen der Besucher an bestimmten Informationen, wie z.B. Inhalten von Webseiten, umfassen. Mit Hilfe der Reichweitenanalyse können Webseiteninhaber z.B. erkennen, zu welcher Zeit Besucher ihre Webseite besuchen und für welche Inhalte sie sich interessieren. Dadurch können sie z.B. die Inhalte der Webseite besser an die Bedürfnisse ihrer Besucher anpassen. Zu Zwecken der Reichweitenanalyse werden häufig pseudonyme Cookies und Web-Beacons eingesetzt, um wiederkehrende Besucher zu erkennen und so genauere Analysen zur Nutzung eines Onlineangebotes zu erhalten. </li><li><strong>Remarketing:</strong> Vom "Remarketing“ bzw. "Retargeting“ spricht man, wenn z.B. zu Werbezwecken vermerkt wird, für welche Produkte sich ein Nutzer auf einer Webseite interessiert hat, um den Nutzer auf anderen Webseiten an diese Produkte, z.B. in Werbeanzeigen, zu erinnern. </li><li><strong>Tracking:</strong> Vom "Tracking“ spricht man, wenn das Verhalten von Nutzern über mehrere Onlineangebote hinweg nachvollzogen werden kann. Im Regelfall werden im Hinblick auf die genutzten Onlineangebote Verhaltens- und Interessensinformationen in Cookies oder auf Servern der Anbieter der Trackingtechnologien gespeichert (sogenanntes Profiling). Diese Informationen können anschließend z.B. eingesetzt werden, um den Nutzern Werbeanzeigen anzuzeigen, die voraussichtlich deren Interessen entsprechen. </li><li><strong>Verantwortlicher:</strong> Als "Verantwortlicher“ wird die natürliche oder juristische Person, Behörde, Einrichtung oder andere Stelle, die allein oder gemeinsam mit anderen über die Zwecke und Mittel der Verarbeitung von personenbezogenen Daten entscheidet, bezeichnet. </li><li><strong>Verarbeitung:</strong> "Verarbeitung" ist jeder mit oder ohne Hilfe automatisierter Verfahren ausgeführte Vorgang oder jede solche Vorgangsreihe im Zusammenhang mit personenbezogenen Daten. Der Begriff reicht weit und umfasst praktisch jeden Umgang mit Daten, sei es das Erheben, das Auswerten, das Speichern, das Übermitteln oder das Löschen. </li><li><strong>Zielgruppenbildung:</strong> Von Zielgruppenbildung (bzw. "Custom Audiences“) spricht man, wenn Zielgruppen für Werbezwecke, z.B. Einblendung von Werbeanzeigen, bestimmt werden. So kann z.B. anhand des Interesses eines Nutzers an bestimmten Produkten oder Themen im Internet geschlussfolgert werden, dass dieser Nutzer sich für Werbeanzeigen für ähnliche Produkte oder den Onlineshop, in dem er die Produkte betrachtet hat, interessiert. Von "Lookalike Audiences“ (bzw. ähnlichen Zielgruppen) spricht man wiederum, wenn die als geeignet eingeschätzten Inhalte Nutzern angezeigt werden, deren Profile bzw. Interessen mutmaßlich den Nutzern, zu denen die Profile gebildet wurden, entsprechen. Zur Zwecken der Bildung von Custom Audiences und Lookalike Audiences werden im Regelfall Cookies und Web-Beacons eingesetzt. </li></ul></p>
<p class="seal"><a href="https://datenschutz-generator.de/?l=de" title="Rechtstext von Dr. Schwenke - für weitere Informationen bitte anklicken." target="_blank">Erstellt mit Datenschutz-Generator.de von Dr. jur. Thomas Schwenke</a></p>

</td></tr></table><br><br>
  <?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'coop')
{
  ?>
 <table width="100%"><tr><td><div class="catGradient borderT borderB"><center><b>Co-Op</b></center></div>
Es ist möglich die Story, NPC, Boss und Eventkämpfe in einer Gruppe abzuschließen.<br/>
Dazu müsst ihr im Profil einfach den Spieler eine Gruppeneinladung schicken.<br/>
Sofern ihr am selben Story-Punkt seid und am selben Ort, werdet ihr die Story zusammen machen.<br/>
Die Stärke der Gegner skaliert jedoch pro Spieler.<br/>
</td></tr></table><br><br>
  <?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'chat')
{
  ?>
 <table width="100%"><tr><td><div class="catGradient borderT borderB"><center><b>Chat</b></center></div>
Im Chat kannst du mit allen Usern schreiben, die gerade online sind.<br/>
Der Haupt-Channel ist "DBBG".<br/>
Du kannst auch mit anderen Nutzern vom Naruto Browsergame schreiben, sie sind im Channel "NBG".<br/>
Auch kannst du eigene Channel erstellen. Ändere dazu einfach in dem linken Eingabefeld den Wert auf deinen Channelnamen.

</td></tr></table><br><br>
  <?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'faq')
{
  ?>
<table width="100%">
<tr><td><div class="catGradient borderT borderB"><center><b>Wie erhalte ich Zeni?</b></center></div>
Zeni kannst du durch verschiedene Aktionen im Spiel erhalten.<br/>
1. Jeden Tag kannst du <b>5</b> Wertungskämpfe machen, wodurch du Zeni erhältst.<br/>
2. Jeden Tag kannst du <b>10</b> NPCKämpfe machen, wodurch du Zeni erhältst.<br/>
3. An bestimmten Tagen kannst du ebenfalls Events machen, die dir auch Zeni geben können.<br/>
4. Die Story kann ebenfalls nach einen Kampf Zeni gewähren.<br/> 
</td></tr>
<tr><td><div class="catGradient borderT borderB"><center><b>Gibt es Raids?</b></center></div>
Es gibt zwei verschiedene Arten von Raids:<br/>
1. Boss
- Bosskämpfe sind tägliche Kämpfe an bestimmten Orten, die du als Gruppe machen kannst um eine Chance auf Rüstungsteile zu bekommen.<br/>
2. Events
- Events sind Kämpfe die zu bestimmten Zeiten an bestimmte Orte stattfinden. Im Ort siehst du, ob es dort ein Event gibt und wann es stattfindet.<br/>
</td></tr>
<tr><td><div class="catGradient borderT borderB"><center><b>Ich bin ein Android, habe aber keinen Chip?</b></center></div>
Du musst zunächst die Aktion "Upgrade" ausführen, dort bekommst du auch einen Chip, wenn du noch keinen hast.<br/>
</td></tr>
</table><br><br>
  <?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'rassen')
{
  ?>
 <table width="100%">
   <tr><td colspan="2"><div class="catGradient borderT borderB"><center><b>Saiyajin</b></center></div></td></tr>
   <tr>
   <td height="380px" width="200px" >
     <div style="position:relative; width:200px; height:380px;">
     <img style="position:absolute; z-index:1;" width="200px" src="img/characters/Saiyajin<?php $randChar = rand(1,5); echo $randChar ?>.png">
     <img style="position:absolute; z-index:2;" width="200px" src="img/characters/Saiyajin<?php echo $randChar; ?>Hair.png">
   <?php if(rand(0,1) == 0) { ?><img style="position:absolute;" width="200px" src="img/characters/SaiyajinTail.png"> <?php } ?>
     </div>
   </td>
   <td valign="top">
   Saiyajin sind starke Krieger die auf dem Planeten Vegeta geboren worden sind.<br/>
   <b>Vorteile:</b><br/>
   Saiyajins haben einen großen Appetit. Dadurch sind Heilitems um 10% effektiver.<br/><br/>
   </td>
   </tr>
   <tr><td colspan="2"><div class="catGradient borderT borderB"><center><b>Mensch</b></center></div></td></tr>
   <tr>
   <td height="380px">
     <div style="position:relative; width:200px; height:380px;">
     <img style="position:absolute; z-index:1;" width="200px" src="img/characters/Mensch<?php $randChar = rand(1,4); echo $randChar ?>.png">
     <img style="position:absolute; z-index:2;" width="200px" src="img/characters/Mensch<?php echo $randChar; ?>Hair.png"></td>
     </div>
   <td valign="top">
   Menschen sind intelligente Wesen, die auf den Planeten Erde geboren werden.<br/>
   <b>Vorteile:</b><br/>
   Durch ihre Bekanntheit auf den Planeten, erhalten Menschen 10% mehr Zeni nach Kämpfen.<br/><br/>
   </td>
   </tr>
   <tr><td colspan="2"><div class="catGradient borderT borderB"><center><b>Freezer</b></center></div></td></tr>
   <tr>
   <td height="380px">
     <div style="position:relative; width:200px; height:380px;">
     <img style="position:absolute; z-index:1;" width="200px" src="img/characters/Freezer<?php $randChar = rand(1,4); echo $randChar ?>.png">
     <img style="position:absolute; z-index:2;" width="200px" src="img/characters/Freezer<?php echo $randChar; ?>Hair.png"></td>
     </div>
   <td valign="top">
   Freezer sind eine Eroberungs-Rasse, die von Planeten zu Planeten reisen und sie erobern.<br/>
   <b>Vorteile:</b><br/>
   Durch ihre Herrschaft haben sie Diener, die sie schneller reisen lassen. Ihre Reisedauer ist permanent um 10% reduziert.<br/><br/>
   </td>
   </tr>
   <tr><td colspan="2"><div class="catGradient borderT borderB"><center><b>Android</b></center></div></td></tr>
   <tr>
   <td height="380px">
     <div style="position:relative; width:200px; height:380px;">
     <img style="position:absolute; z-index:1;" width="200px" src="img/characters/Android<?php $randChar = rand(1,5); echo $randChar ?>.png">
     <img style="position:absolute; z-index:2;" width="200px" src="img/characters/Android<?php echo $randChar; ?>Hair.png"></td>
     </div>
   <td valign="top">
   Androiden sind künstliche Wesen, die von einer anderen Rasse erschaffen worden sind.<br/>
   <b>Vorteile:</b><br/>
   Sie haben einen Chip, den sie durch eine Aktion jeden Level verbessern können.<br/><br/>
   </td>
   </tr>
   <tr><td colspan="2"><div class="catGradient borderT borderB"><center><b>Majin</b></center></div></td></tr>
   <tr>
   <td height="380px">
     <div style="position:relative; width:200px; height:380px;">
     <img style="position:absolute; z-index:1;" width="200px" src="img/characters/Majin<?php $randChar = rand(1,4); echo $randChar ?>.png">
     <img style="position:absolute; z-index:2;" width="200px" src="img/characters/Majin<?php echo $randChar; ?>Hair.png"></td>
     </div>
   <td valign="top">
   Majin sind magische Wesen, die einen einzigartigen Körper besitzen.<br/>
   <b>Vorteile:</b><br/>
   Sie können für eine Stunde schlafen, wodurch sie ihre LP und KP vollständig wiederherstellen.<br/><br/>
   </td>
   </tr>
   <tr><td colspan="2"><div class="catGradient borderT borderB"><center><b>Demon</b></center></div></td></tr>
   <tr>
   <td height="380px">
     <div style="position:relative; width:200px; height:380px;">
     <img style="position:absolute; z-index:1;" width="200px" src="img/characters/Demon<?php $randChar = rand(1,4); echo $randChar ?>.png">
     <img style="position:absolute; z-index:2;" width="200px" src="img/characters/Demon<?php echo $randChar; ?>Hair.png"></td>
     </div>
   <td valign="top">
   Demon sind bösartige Wesen, die aus der Hölle kommen.<br/>
   <b>Vorteile:</b><br/>
   Dadurch dass sie so gefürchtet werden, haben sie eine 10% erhöhte Chance, durch Kämpfe Items zu erhalten.<br/><br/>
   </td>
   </tr>
   <tr><td colspan="2"><div class="catGradient borderT borderB"><center><b>Kaioshin</b></center></div></td></tr>
   <tr>
   <td height="380px">
     <div style="position:relative; width:200px; height:380px;">
     <img style="position:absolute; z-index:1;" width="200px" src="img/characters/Kaioshin<?php $randChar = rand(1,4); echo $randChar ?>.png">
     <img style="position:absolute; z-index:2;" width="200px" src="img/characters/Kaioshin<?php echo $randChar; ?>Hair.png"></td>
     </div>
   <td valign="top">
   Kaioshin sind Wesen, die über alle anderen Wesen wachen.<br/>
   <b>Vorteile:</b><br/>
   Sie können jeden Level einzigartige Items herrstellen, die sie oder andere nutzen können.<br/><br/>
   </td>
   </tr>
   <tr><td colspan="2"><div class="catGradient borderT borderB"><center><b>Namekianer</b></center></div></td></tr>
   <tr>
   <td height="380px">
     <div style="position:relative; width:200px; height:380px;">
     <img style="position:absolute; z-index:1;" width="200px" src="img/characters/Namekianer<?php $randChar = rand(1,4); echo $randChar ?>.png">
     <img style="position:absolute; z-index:2;" width="200px" src="img/characters/Namekianer<?php echo $randChar; ?>Hair.png"></td>
     </div>
   <td valign="top">
   Namekianer sind ruhige Lebewesen, die auf den Planeten Namek geboren worden sind.<br/>
   Sie haben zwei Besonderheiten:<br/><br/>
   <b>Vorteile:</b><br/>
   Durch ihre gute Heilungskraft, heilen Namekianer sich nach einen Kampf um 10% ihrer maximalen LP und KP. Dies übertrifft jedoch nicht ihre vorherige LP und KP.<br/><br/>
   </td>
   </tr>
   </table><br><br>
  <?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'techniken')
{
  ?>
<table width="100%" cellspacing="0" class="boxSchatten">
  <tr>
    <td colspan=4 class="catGradient borderT borderB" align="center">
      <b> <font color="white"><div class="schatten">Suchen</div></font> </b>
    </td>
  </tr>
  <tr style ="boxSchatten">
    <td width="30%"><b> Name </b></td>
    <td width="30%"><b> Rasse </b></td>
    <td width="30%"><b> Type </b></td>
    <td width="10%"><b>  </b></td>
  </tr>
  <tr>
      <form method="GET" action="?p=info&info=techniken">
        <input type="hidden" name="p" value="info">
        <input type="hidden" name="info" value="techniken">
    <td width="40%" style ="boxSchatten"> 
      <input style="width:90%;" type="text" name="attackenname" value="<?php if(isset($_GET['attackenname'])) echo $_GET['attackenname']; ?>"> 
    </td>
    <td width="40%" style ="boxSchatten">  
    <select class="select" name="attackenrasse" id="racelist">
        <option value="" <?php if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] == '') echo 'selected'; ?>>Alle</option>
        <option value="none" <?php if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] == 'none') echo 'selected'; ?>>Keine</option>
        <option value="Saiyajin" <?php if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] == 'Saiyajin') echo 'selected'; ?>>Saiyajin</option>
        <option value="Mensch" <?php if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] == 'Mensch') echo 'selected'; ?>>Mensch</option>
        <option value="Freezer" <?php if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] == 'Freezer') echo 'selected'; ?>>Freezer</option>
        <option value="Kaioshin" <?php if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] == 'Kaioshin') echo 'selected'; ?>>Kaioshin</option>
        <option value="Android" <?php if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] == 'Android') echo 'selected'; ?>>Android</option>
        <option value="Majin" <?php if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] == 'Majin') echo 'selected'; ?>>Majin</option>
        <option value="Demon" <?php if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] == 'Demon') echo 'selected'; ?>>Demon</option>
        <option value="Namekianer" <?php if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] == 'v') echo 'selected'; ?>>Namekianer</option>
       </select><br>
    </td>
    <td width="40%" style ="boxSchatten">  
    <select class="select" name="attackentyp" id="attackentyp">
        <option value="" <?php if(isset($_GET['attackentyp']) && $_GET['attackentyp'] == '') echo 'selected'; ?>>Alle</option>
        <?php
        for($i = 1; $i <= 22; ++$i)
        {
          if($i == 11 || $i == 7 || $i == 8 || $i == 10 || $i == 14 || $i == 15 || $i == 16)
            continue;
         ?> <option value="<?php echo $i; ?>" <?php if(isset($_GET['attackentyp']) && $_GET['attackentyp'] == $i) echo 'selected'; ?>><?php echo Attack::GetTypeName($i); ?></option><?php
        }
        ?>
       </select><br>
    </td>
    <td width="20%" style ="boxSchatten"> 
      <input type="submit" style="width:90%" value="Suchen">
     </td>
    </form>
  </tr>
</table>
<br/>
<table width="100%" cellspacing="0" class="boxSchatten">
  <tr>
    <td class="catGradient borderB borderT borderR borderL" colspan="9" align="center"><b>Techniken</b></td>
  </tr>
  <tr>
    <td width="10%" class="borderL" align="center"><b>Bild</b></td>
    <td width="15%" align="center"><b>Name</b></td>
    <td width="5%" align="center"><b>Typ</b></td>
    <td width="50%" align="center"><b>Wirkung</b></td>
    <td width="40%" align="center"><b>Genauigkeit</b></td>
    <td width="10%" align="center"><b>Kosten</b></td>
    <td width="10%" align="center"><b>Runden</b></td>
    <td width="10%" align="center"><b>Dauer</b></td>
  </tr>
  <?php
  $where = 'displayed="1"';
  $order = 'type,procentual,value, rounds, race';
  if(isset($_GET['attackenname']) && $_GET['attackenname'] != '')
  {
    $where = $where.' AND name LIKE "%'.$_GET['attackenname'].'%"';
  }
  if(isset($_GET['attackentyp']) && $_GET['attackentyp'] != '')
  {
    $where = $where.' AND type='.$_GET['attackentyp'].'';
  }
  if(isset($_GET['attackenrasse']) && $_GET['attackenrasse'] != '')
  {
    if($_GET['attackenrasse'] == 'none')
    {
      $where = $where.' AND race LIKE ""';
    }
    else
    {
      $where = $where.' AND race LIKE "%'.$_GET['attackenrasse'].'%"';
    }
    if($_GET['attackenrasse'] == 'Saiyajin')
    {
      $where = $where.' AND race NOT LIKE "Halb-Saiyajin"';
    }
  }
  $attacks = new Generallist($database, 'attacks', '*', $where, $order, 99999999999, 'ASC');
  $id = 0;
  $entry = $attacks->GetEntry($id);
  while($entry != null)
  {
    ?>
    <tr>
    <td width="50px" class="borderL borderB" align="center">
      <img class="boxSchatten" src="img/attacks/<?php echo $entry['image']; ?>.png" width="50px" height="50px"></img>
      </div> 
    </td>
    <td align="center" id="<?php echo $entry['id']; ?>"><?php echo $entry['name']; ?></td>
    <td align="center"><?php echo Attack::GetTypeName($entry['type']); ?></td>
    <td align="center">
      <?php 
      if($entry['type'] == 3)
      {
        ?>Ziel benötigt <?php echo $entry['value']; ?>% LP<?php
      }
      if($entry['type'] == 1 || $entry['type'] == 12)
      {
        $value = 'lpvalue';
        if($entry[$value] != 0)
        {
          $valName = 'LP';
          echo round($entry['value'] * $entry[$value]/100);
          if($entry['procentual'])
            echo '%';
          echo ' KI Schaden an '.$valName.'<br/>';
        }
        $value = 'kpvalue';
        if($entry[$value] != 0)
        {
          $valName = 'KP';
          echo round($entry['value'] * $entry[$value]/100);
          if($entry['procentual'])
            echo '%';
          echo ' KI Schaden an '.$valName.'<br/>';
        }
        $value = 'epvalue';
        if($entry[$value] != 0)
        {
          $valName = 'EP';
          echo round($entry['value'] * $entry[$value]/100);
          if($entry['procentual'])
            echo '%';
          echo ' KI Schaden an '.$valName.'<br/>';
        }
      }
      else if($entry['type'] == 5 || $entry['type'] == 11)
      {
        $value = 'lpvalue';
        if($entry[$value] != 0)
        {
          $valName = 'LP';
          echo round($entry['value'] * $entry[$value]/100);
          if($entry['procentual'])
            echo '%';
          echo ' KI Heilung an '.$valName.'<br/>';
        }
        $value = 'kpvalue';
        if($entry[$value] != 0)
        {
          $valName = 'KP';
          echo round($entry['value'] * $entry[$value]/100);
          if($entry['procentual'])
            echo '%';
          echo ' KI Heilung an '.$valName.'<br/>';
        }
        $value = 'epvalue';
        if($entry[$value] != 0)
        {
          $valName = 'EP';
          echo round($entry['value'] * $entry[$value]/100);
          if($entry['procentual'])
            echo '%';
          echo ' KI Heilung an '.$valName.'<br/>';
        }
      }
      else if($entry['type'] == 9 || $entry['type'] == 19)
      {
        echo $entry['value'];
      }
      else if($entry['type'] == 6)
      {
        echo $entry['value'] .' % KI pro Ladung';
      }
      else
      {
        $value = 'lpvalue';
        $valName = 'LP';
        if($entry[$value] != 0)
        {
          if($entry['type'] == 20 || $entry['type'] == 2)
            echo $valName.' x ';

          echo $entry['value'] * $entry[$value]/100;
          if($entry['procentual'])
            echo '%';
          
          if($entry['type'] == 18 || $entry['type'] == 22)
            echo ' KI auf';
            
          if($entry['type'] != 20 && $entry['type'] != 2)
            echo ' '.$valName;

          echo '<br/>';
        }
        $value = 'kpvalue';
        $valName = 'KP';
        if($entry[$value] != 0)
        {
          if($entry['type'] == 20 || $entry['type'] == 2)
            echo $valName.' x ';

          echo $entry['value'] * $entry[$value]/100;
          if($entry['procentual'])
            echo '%';
          
          if($entry['type'] == 18 || $entry['type'] == 22)
            echo ' KI auf';

          if($entry['type'] != 20 && $entry['type'] != 2)
            echo ' '.$valName;

          echo '<br/>';
        }
        $value = 'epvalue';
        $valName = 'Energie';
        if($entry[$value] != 0)
        {
          if($entry['type'] == 20 || $entry['type'] == 2)
            echo $valName.' x ';

          echo $entry['value'] * $entry[$value]/100;
          if($entry['procentual'])
            echo '%';
          
          if($entry['type'] == 18 || $entry['type'] == 21 || $entry['type'] == 22)
            echo ' KI auf';

          if($entry['type'] != 20 && $entry['type'] != 2)
            echo ' '.$valName;

          echo '<br/>';
        }
        $value = 'atkvalue';
        $valName = 'Angriff';
        if($entry[$value] != 0)
        {
          if($entry['type'] == 20 || $entry['type'] == 2)
            echo $valName.' x ';

          echo $entry['value'] * $entry[$value]/100;
          if($entry['procentual'])
            echo '%';

          if($entry['type'] == 18 || $entry['type'] == 21 || $entry['type'] == 22)
            echo ' KI auf';

          if($entry['type'] != 20 && $entry['type'] != 2)
            echo ' '.$valName;

          echo '<br/>';
        }
        $value = 'defvalue';
        $valName = 'Verteidigung';
        if($entry[$value] != 0)
        {
          if($entry['type'] == 20 || $entry['type'] == 2)
            echo $valName.' x ';

          echo $entry['value'] * $entry[$value]/100;
          if($entry['procentual'])
            echo '%';
          
          if($entry['type'] == 18 || $entry['type'] == 21 || $entry['type'] == 22)
            echo ' KI auf';

          if($entry['type'] != 20 && $entry['type'] != 2)
            echo ' '.$valName;

          echo '<br/>';
        }
        $value = 'tauntvalue';
        $valName = 'Anziehung';
        if($entry[$value] != 0)
        {
          if($entry['type'] == 20 || $entry['type'] == 2)
            echo $valName.' x ';

          echo $entry['value'] * $entry[$value]/100;
          if($entry['procentual'])
            echo '%';
          
          if($entry['type'] == 18 || $entry['type'] == 21 || $entry['type'] == 22)
            echo ' KI auf';

          if($entry['type'] != 20 && $entry['type'] != 2)
            echo ' '.$valName;

          echo '<br/>';
        }
        $value = 'reflectvalue';
        $valName = 'Reflektion';
        if($entry[$value] != 0)
        {
          if($entry['type'] == 2)
            echo $valName.' x ';

          echo $entry['value'] * $entry[$value]/100;
          if($entry['procentual'])
            echo '%';
          
          if($entry['type'] == 18 || $entry['type'] == 21 || $entry['type'] == 22)
            echo ' KI auf';

          if($entry['type'] != 2)
            echo ' '.$valName;

          echo '<br/>';
        }
        
      }
      ?>
      </td>
    <td align="center">
      <?php echo $entry['accuracy']; ?>%
  </td>
    <td align="center">
      <?php 
     if($entry['energy'] != 0)
      echo $entry['energy'].' EP<br/>'; 
      if($entry['lp'] != 0)
      {
        if($entry['procentualcost'] == 1) echo ($entry['lp'] / 100).'%'; else echo $entry['lp'];
        echo ' LP<br/>';
      }
      if($entry['kp'] != 0)
      {
        if($entry['procentualcost'] == 1) echo ($entry['kp'] / 100).'%'; else echo $entry['kp'];
        echo ' KP<br/>';
      }
      ?>
    </td>
    <td align="center">
      <?php //if($entry['learnki'] != 0) echo 'KI:'.$entry['learnki'].'<br/>'; ?>
      <?php //if($entry['learnlp'] != 0) echo 'LP:'.$entry['learnlp'].'<br/>'; ?>
      <?php //if($entry['learnkp'] != 0) echo 'KP:'.$entry['learnkp'].'<br/>'; ?>
      <?php //if($entry['learnattack'] != 0) echo 'Attack:'.$entry['learnattack'].'<br/>'; ?>
      <?php //if($entry['learndefense'] != 0) echo 'Defense:'.$entry['learndefense'].'<br/>'; ?>
      <?php 
      $runden = $entry['rounds']+1;
      if($runden > 0)
      {
        echo $runden.' ';
        if($runden == 1) echo 'Runde'; else echo 'Runden';
      }
      ?>
    </td>
    <td align="center"><?php echo $entry['race']; ?></td>
    </tr>
    <tr>
    <td colspan="9" class="borderB"><?php echo $entry['description']; ?></td>
    </tr>
    <?php
    ++$id;
    $entry = $attacks->GetEntry($id);
  }
  ?>
  </table>
  <?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'clan')
{
?> 
 <table width="100%"><tr><td>
 <div class="catGradient borderT borderB"><center><b>Clan Infos</b></center></div>
 <br>
 <b>Der Clan</b><br>
Ein Gruppe von Usern kann sich zu einem Clan zusammenschließen.<br>
Entweder man gründet einen eigenen oder tritt einen bestehenden Clan bei.<br>
Man muss mindestens Level 4 sein um ein Clan erstellen oder beitreten zu können.<br>
<br>
<b>Was bringt ein Clan?</b><br>
Im Clan gibt es eine Clankasse, in der ihr Zeni einzahlen könnt und dies auf die Clanmitglieder verteilen könnt.<br/>
Ebenfalls könnt ihr hier Zeni in Punkte umwandeln, was für das Ranking entscheident ist.<br/>
<br>
<br>
<b>Wie schließ ich mich einem Clan an?</b><br>
Man klickt auf „Clan beitreten“, dann sucht man den entsprechenden Clannamen aus.<br>
Somit schickt man eine Anfrage an den Clan an. Dieser wird dann die Aufnahme bestätigen oder ablehnen.<br>
<br>
<b>Clan Gründen</b><br>
Unter dem Menüpunkt „Clan erstellen“ gründet man einen eigenen Clan.<br>
Man ist dann automatisch der Leader des Clans.<br>
Die Gründungskosten betragen 2000 Zeni.<br>
Als Leader hast du volle Administrationsrechte deines Clans.<br>
<br>
<b>Clanoptionen</b><br>
Der Leader bzw. Coleader hat die Möglichkeit die Clanbeschreibung zu ändern.<br>
Ebenso können Clanbild und Clanwappen eingefügt werden, welche im Clanprofil und auf dem eigenen Profil sichtbar sind.<br>
Außerdem kann man die Clanbeschreibung ändern, Regeln einfügen etc.	 <br>
</td></tr></table><br><br>

<?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'items')
{
?> 
 <table width="100%"><tr><td>
 <div class="catGradient borderT borderB"><center><b>Items Infos</b></center></div>
 <br>
<b>Items</b><br>
Items können im Shop gekauft werden und sind in den verschiedensten Formen vertreten.<br>
Ebenso kann man Items im Marktplatz kaufen oder zum Verkauf anbieten.<br>
Auch durch NPC Kämpfe, Dungeons und Events kann man Items bekommen.<br/>
<br>

<b>Heilitems:</b><br>
Diese Items werden benötigt um deine LP und KP zu heilen.<br>
<br>
<b>Waffen:</b><br>
Im Shop findet man verschiedene Waffe welche man je nach Level ausrüsten kann.<br>
Diese steigern deinen Angriff im Kampf.<br>
<b>Rüstungen:</b>
Rüstungen können ebenfalls im Shop gekauft werden und steigern deine Verteidigung im Kampf.<br>
<br>
<b>Sonstiges:</b><br>
Dazu gehören besondere Items, wie Potara oder der Dragonball Radar.<br/>
<br>
</td></tr>
<tr>
<td>
 <div class="catGradient borderT borderB"><center><b>Formen von Items</b></center></div>
Ausrüstbare Items können verschiedene Formen annehmen.<br/>
Diese Formen bestimmen, welche Werte gestärkt werden.<br/>
Es folgt eine Erklärung der Formen:<br/><br/>
<b>Balance</b><br/>
- Steigert LP, KP, Angriff und Abwehr<br/>
<b>Angriff</b><br/>
- Steigert Angriff<br/>
<b>Verteidigung</b><br/>
- Steigert Abwehr<br/>
<b>Leben</b><br/>
- Steigert LP<br/>
<b>Kraft</b><br/>
- Steigert KP<br/>
<b>Kontrolle</b><br/>
- Steigert Angriff und Abwehr<br/>
<b>Stärke</b><br/>
- Steigert Angriff und LP<br/>
<b>Zerstörung</b><br/>
- Steigert Angriff und KP<br/>
<b>Ehre</b><br/>
- Steigert Abwehr und LP<br/>
<b>Schutz</b><br/>
- Steigert Abwehr und KP<br/>
<b>Energie</b><br/>
- Steigert LP und KP<br/>
<b>Ausgleich</b><br/>
- Steigert Angriff, Abwehr und LP<br/>
<b>Macht</b><br/>
- Steigert Angriff, Abwehr und KP<br/>
<b>Offensiv</b><br/>
- Steigert Angriff, LP und KP<br/>
<b>Defensiv</b><br/>
- Steigert Abwehr, LP und KP<br/>  
</td>   
   
</tr>

</table><br><br>

<?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'dbs')
{
?> 
 <table width="100%"><tr><td>
 <div class="catGradient borderT borderB"><center><b>Dragonball Infos</b></center></div>
 <br>
<b>Die Dragonballs</b><br>
Die Dragonballs sind magische Kugeln.<br>
Wer alle 7 Dragonballs besitzt, kann Shenlong rufen und darf seinen Wunsch aussprechen.<br>
<br>
<b>Die Suche:</b><br>
Wer erfolgreich einen Radar im Shop erworben hat, kann die Dragonballs suchen.<br>
Nun ist die Funktion 'Radar' unter der Karte sichtbar.<br>
Sobald man diese anwählt, zeigt eine Minimap die ungefähre Position an.<br>
Ebenso werden Dragonballs in deinem Besitz dort angezeigt.<br>
<br>
<b>Wo gibt es Dragonballs?</b><br>
Die Dragonballs sind nur auf dem Planeten Erde, Namek und Alt-Namek zu finden, falls sie vorhanden sind.<br>

<br>
<b>Wann kommen die Dragonballs wieder?</b><br>
Nachdem jemand seinen Wunsch ausgesprochen hat, verschwinden die Dragonballs auf dem Radar.<br>
Nach 7 Tagen werden sie erneut irgendwo auf der Karte erscheinen.<br>
<br>
<b>Dragonballkampf</b><br>
Sollte jemand schon einen Dragonball besitzen kannst du ihm diesen durch einen Dragonballkampf abnehmen.<br>
Du kannst andere User zum Dragonballkampf im Radarmenü herausfordern.<br>
Diese starten als 1 vs 1 Kämpfe, es können jedoch andere Suchende jederzeit einmischen.<br>
Der Kampf startet automatisch und den Dragonball bekommt der Sieger.<br>
<br>
<b>Der Wunsch</b><br>
Wenn du alle 7 Dragonballs gefunden hast, kannst du deinen Wunsch aussprechen.<br>
Im Radar wird nun 'Shenlong Rufen' auftauchen.<br>
Du musst dabei sehr schnell sein, denn deine Dragonballs können sehr schnell wieder verloren gehen.<br>
Du kannst danach 1 Wunsch äußern.<br>
</td></tr></table><br><br>

<?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'allgemeines')
{
?> 

 <table width="100%"><tr><td><div class="catGradient borderT borderB"><center><b>Allgemeines:</b></center></div>
<b>KI (Kampfkraft):</b><br>
Deine KI entscheidet darüber, wie viel Schaden du durch körperliche Angriffe anrichtest.<br>
Um stärkere Techniken erlernen zu können, braucht man eine gewisse KI.<br>
Je mehr KI man hat, desto stärker ist man.<br>
<br>
<b>LP (Lebenspunkte):</b><br>
Deine LP entscheidet, wieviele Treffer du einstecken kannst.
Umso mehr LP du hast, umso länger hältst du im Kampf durch.<br>
Dies ist der rote Balken.<br>
<br>
<b>KP (KI-Punkte):</b><br>
Die KP werden für Techniken oder Spezialangriffe gebraucht und verbraucht.<br>
Dies ist der grüne Balken.<br>
<br>
<b>EP (Energie-Punkte):</b><br>
Die EP ist deine Ausdauer. Manche Techniken benötigen mehr EP und daher kannst du sie nicht oft hintereinander einsetzen.<br>
Dies ist der gelbe Balken.<br/>
<br>
<b>Angriff:</b><br>
Der Angriff erhöht den Schaden der durch Techniken verursacht wird.<br>
<br>
<b>Verteidigung:</b><br>
Die Verteidigung verringert den erlittenen Schaden im Kampf.<br>
<br>
<b>Story</b><br>
In der Kampagne musst du verschiedene Aufgaben erledigen, um dein Level zu steigern.<br>
Durch jeden besiegten Gegner steigt dein Level.<br>
Um das maximal Level zu erreichen, muss man also bis zum letzten Gegner vorschreiten.<br>
Durch jeden Sieg erhält man Statspunkte und Zeni.<br>
<br>
<b>Stats:</b><br>
Durch ein Levelup, werden <b>10 Statspunkte</b> hinzugefügt, die du frei verteilen kannst.<br/>
Zusätzlich erhälst du nach <b>10 Wertungskämpfe</b> pro Level ebenfalls <b>10 Statspunkte</b>.<br>
<br>
<b>Zenis:</b><br>
Du kannst am Tag <b>5</b> Wertungskämpfe machen. Je nach gewonnen oder verlorenen Kampf erhälst du Zeni.<br/>
NPCKämpfe geben dir eben so bei gewonnen Kampf Zeni, diese sind aber auf <b>10</b> Tägliche Kämpfe Limitiert.<br/>
<br>
<b>Reise:</b><br>
Die Reise dauer zwischen zwei Orten sind immer unterschiedlich. Bei Reise abbruch musst du ein neues Reise Ziel auf der Karte auswählen.<br/>
Die Rückreise zu deinem vorherigen Standort liegt hier bei 5 Minuten.<br/>
</td></tr></table><br><br>
<?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'regeln')
{
?>

 <table style="table-layout: fixed;" valign="top" width="100%">
   <tr><td>
</div>
<table width="100%" cellspacing="0" border="0" style="vertical-align:top;" valign="top">
  <tr>
    <td class="catGradient borderB borderT" colspan="6" align="center"><b>Regeln</b></td>
  </tr>
  <tr>
      <td width="50%" style="vertical-align:top;">
          <details>
            <summary style="table-layout: fixed;"><b><font color="0066FF">§1:</font> Mehrere Charaktere/Accounts.</b></summary>
            <fieldset>
              <legend><b>Beschreibung:</b></legend>
              <table>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr1:</font></b></td>
                  <td> Charaktere die man auf einen oder weiteren Accounts hat dürfen nicht miteinander interagieren.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr2:</font></b></td>
                  <td> Es dürfen keine Items oder Zeni übertragen werden. Weder über Handel, noch über andere Wege oder Drittuser. </td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr3:</font></b></td>
                  <td> Es darf nur mit einen Charakter die Dragonballs gesucht werden.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr4:</font></b></td>
                  <td> Nur Spaßkämpfe sind mit eigenen Charakteren erlaubt.</td>
                </tr>
                <tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr5:</font></b></td>
                  <td> Charaktere eines Accounts dürfen zudem nicht in den selben Clan sein.</td>
                </tr>
                <tr>
                  <td>
                  </td>
                </tr>
              </table>
            </fieldset>
          </details>

      </td>
    </tr>
    <tr>
      <td width="50%" style="vertical-align:top;">

          <details>
            <summary><b><font color="0066FF">§2:</font> Beleidigungen.</b></summary>
            <fieldset>
              <legend><b>Beschreibung:</b></legend>
              <table>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr1:</font></b></td>
                  <td> Das direkte und indirekte Beleidigen anderer User ist strengstens untersagt.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr2:</font></b></td>
                  <td> Ebenfalls ist die Nutzung von Schimpfwörtern oder Wörtern, die Schimpfwörter ähneln, verboten. </td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr3:</font></b></td>
                  <td> Provokationen können auch zu einem Verstoß führen.</td>
                </tr>
                <tr>
                  <td>
                  </td>
                </tr>
              </table>
            </fieldset>

          </details>

      </td>
      <td width="50%" style="vertical-align:top;">

          <details>
            <summary><b><font color="0066FF">§3:</font> Fremdwerbung.</b></summary>
            <fieldset>
              <legend><b>Beschreibung:</b></legend>
              <table>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr1:</font></b></td>
                  <td> Alle Arten von Seitenverlinkungen oder Werbung im Game und im Forum sind verboten. Da wir uns von diesen distanzieren, sind alle Verlinkungen zu anderen Seiten grundsätzlich verboten.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr2:</font></b></td>
                  <td> Dazu gehört auch das Werben anderer Seiten und das Erwähnen anderer Spiele. </td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr3:</font></b></td>
                  <td> Somit kann sogenannte Schleichwerbung ebenfalls geahndet werden.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr4:</font></b></td>
                  <td> Dies gilt für alle Bereiche auf DBBG.
                  </td>
                </tr>
                <tr>
                  <td>
                  </td>
                </tr>
              </table>
            </fieldset>

          </details>

      </td>
    </tr>
    <tr>
      <td width="50%" style="vertical-align:top;">



          <details>
            <summary><b><font color="0066FF">§4:</font> Identitätsdiebstahl.</b></summary>
            <fieldset>
              <legend><b>Beschreibung:</b></legend>
              <table>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr1:</font></b></td>
                  <td> Sich als der Admin oder als ein Supporter/Moderator bzw. ein Zuständiger von DBBG auszugeben oder Aussagen aus ihrer Seite zu fälschen ist untersagt.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr2:</font></b></td>
                  <td> Außerdem ist es nicht gestattet, sich als ein anderer User oder einen anderen Clan auszugeben.</td>
                </tr>
                <tr>
                  <td>
                  </td>
                </tr>
              </table>
            </fieldset>

          </details>

      </td>
      <td width="50%" style="vertical-align:top;">



          <details>
            <summary><b><font color="0066FF">§5:</font> Chat.</b></summary>
            <fieldset>
              <legend><b>Beschreibung:</b></legend>
              <table>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr1:</font></b></td>
                  <td> Das Provozieren anderer User im DBBG Chat ist strengstens untersagt</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr2:</font></b></td>
                  <td> Dazu gehören gezielte Provokationen die zu Konflikte führen. </td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr3:</font></b></td>
                  <td> Moderatoren/Supporter sind berechtigt, bestimmte Diskussionen und Gesprächsthemen zu beenden oder zu verbieten, wenn diese sich negativ auf die Chat auswirken (In Form von verärgerte User, ungeeigneter Gesprächsstoff, anstößige Inhalte,
                    Inhalte die nicht gern gesehen bzw. unpassend sind) </td>
                </tr>
                <tr>
                  <td>
                  </td>
                </tr>
              </table>
            </fieldset>


          </details>

      </td>
    </tr>
    <tr>
      <td width="50%" style="vertical-align:top;">

          <details>
            <summary><b><font color="0066FF">§6:</font> Sprache.</b></summary>
            <fieldset>
              <legend><b>Beschreibung:</b></legend>
              <table>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr1:</font></b></td>
                  <td> Die Kommunikation findet in der deutschen Sprache statt!</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr2:</font></b></td>
                  <td> Gespräche in einer Fremdsprache sind in öffentlichen Bereichen von DBBG verboten.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr3:</font></b></td>
                  <td> Ausgenommen von dieser Regel sind einzelne Begriffe und Aussagen. </td>
                </tr>
                <tr>
                  <td>
                  </td>
                </tr>
              </table>
            </fieldset>

          </details>

      </td>
      <td width="50%" style="vertical-align:top;">
   

          <details>
            <summary><b><font color="0066FF">§7:</font> Fake Fights verboten.</b></summary>
            <fieldset>
              <legend><b>Beschreibung:</b></legend>
              <table>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr1:</font></b></td>
                  <td> Es gilt als Verstoß, einen Kampf absichtlich zu verlieren. </td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr2:</font></b></td>
                  <td> Ebenfalls verboten ist es, einen Fake Kampf gegen Zeni auszutragen.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr3:</font></b></td>
                  <td> Fakefightverbot gilt für alle Kampfarten und Situationen.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr4:</font></b></td>
                  <td> Es ist ebenfalls verboten im Offline-Status in Kämpfen beteiligt zu sein oder jemanden im Offlinemodus in einen Kampf zu ziehen. Eine Ausnahme zum Offline-Status stellen die Dragonballkämpfe dar. Fakefights generell sind jedoch überall
                    verboten (Auch im Dragonballkampf).</td>
                </tr>
                <tr>
                  <td>
                  </td>
                </tr>
              </table>
            </fieldset>
          </details>
  
      </td>
    </tr>
    <tr>
      <td width="50%" style="vertical-align:top;">
      
          <details>
            <summary><b><font color="0066FF">§8:</font> Bot Using.</b></summary>
            <fieldset>
              <legend><b>Beschreibung:</b></legend>
              <table>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr1:</font></b></td>
                  <td> Die Nutzung von Bot/Refresher ist verboten. </td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr2:</font></b></td>
                  <td> Außerdem ist es verboten sich über mehrere Plattformen gleichzeitig einzuloggen.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr3:</font></b></td>
                  <td> Das Verfälschen der eigenen IP-Adresse ist nicht gestattet.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Strafe:</font></b></td>
                  <td> Alle Arten von Umgehen der Eigenklicks führen bei Bekanntmachung zur direkten Sperre/Bann.</td>
                </tr>
                <tr>
                  <td>
                  </td>
                </tr>
              </table>
            </fieldset>
          </details>
   
      </td>
      <td width="50%" style="vertical-align:top;">
 
          <details>
            <summary><b><font color="0066FF">§9:</font> Bilder und Texte</b></summary>
            <fieldset>
              <legend><b>Beschreibung:</b></legend>
              <table>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr1:</font></b></td>
                  <td> Es ist nicht erlaubt pornografische / nicht jugendfreie Bilder im Profil oder in Texten darzustellen oder zu verlinken. </td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr2:</font></b></td>
                  <td> Ebenfalls sind rassistische Aussagen und Bilder verboten.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr3:</font></b></td>
                  <td> Bilder und Texte mit politischen und religiösen Inhalten können verboten werden.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr4:</font></b></td>
                  <td> Es ist außerdem nicht erlaubt, Bilder und Texte anderer User ohne ihre ausdrückliche Erlaubnis zu verwenden.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr5:</font></b></td>
                  <td> Es dürfen keine Erwähnungen von realen Menschen oder Gewerben in Bildern oder Texten vorkommen.</td>
                </tr>
                <tr>
                  <td></td>
                </tr>
              </table>
            </fieldset>
          </details>

      </td>
    </tr>
    <tr>
      <td width="50%" style="vertical-align:top;">
  
          <details>
            <summary><b><font color="0066FF">§10:</font> Spam</b></summary>
            <fieldset>
              <legend><b>Beschreibung:</b></legend>
              <table>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr1:</font></b></td>
                  <td> Spammen ist in jeder Form verboten.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr2:</font></b></td>
                  <td> Dies gilt in Form von PM / Newskommentar / Chatpost.</td>
                </tr>
                <tr>
                  <td>
                    <b><font color="0066FF">Nr3:</font></b></td>
                  <td> Das Absenden identischer Beiträge sollte vermieden werden und wird ebenfalls als Spam gewertet.</td>
                </tr>
                <tr>
                  <td>
              </table>
            </fieldset>
          </details>
 
        </td>
        <td width="50%" style="vertical-align:top;">
      
            <details>
              <summary><b><font color="0066FF">§11:</font> News Kommentare</b></summary>
              <fieldset>
                <legend><b>Beschreibung:</b></legend>
                <table>
                  <tr>
                    <td>
                      <b><font color="0066FF">Nr1:</font></b></td>
                    <td> Dein Kommentar soll sich nur auf den aktuellen News Post beziehen.</td>
                  </tr>
                  <tr>
                    <td>
                      <b><font color="0066FF">Nr2:</font></b></td>
                    <td> Dein Kommentar darf keine Beleidigungen, rassistischen oder ponografischen Inhalte und/oder Texte enthalten.</td>
                  </tr>
                  <tr>
                    <td>
                      <b><font color="0066FF">Nr3:</font></b></td>
                    <td> Dein Kommentar darf kein duplikat eines anderen Kommentares sein.</td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                </table>
              </fieldset>
            </details>
     
        </td>
        </tr>
        <tr>
          <td width="50%" style="vertical-align:top;">
 
              <details>
                <summary><b><font color="0066FF">§12:</font> Bug Using</b></summary>
                <fieldset>
                  <legend><b>Beschreibung:</b></legend>
                  <table>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr1:</font></b></td>
                      <td> Das Ausnutzen von Bugs im Spiel ist verboten. </td>
                    </tr>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr2:</font></b></td>
                      <td> Diese müssen direkt gemeldet werden. Ansonsten ist das Bugusing und führt zu einer Sperre. </td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                </fieldset>
              </details>
          
          </td>
          <td width="50%" style="vertical-align:top;">
         
              <details>
                <summary><b><font color="0066FF">§13:</font> Entsperrungsanfragen</b></summary>
                <fieldset>
                  <legend><b>Beschreibung:</b></legend>
                  <table>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr1:</font></b></td>
                      <td> Entsperrungsanfragen/Verwarnungsanfragen gehören an den Support.</td>
                    </tr>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr2:</font></b></td>
                      <td> Dies darf nur von der gesperrten bzw. verwarnten Person angefragt werden.</td>
                    </tr>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr3:</font></b></td>
                      <td> Die Anfrage nach Entsperrungsinformationen ist für Drittpersonen weder an die Moderation, noch in öffentlichen Bereichen gestattet.</td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                </fieldset>
              </details>
     
          </td>
        </tr>
        <tr>
          <td width="50%" style="vertical-align:top;">
          
              <details>
                <summary><b><font color="0066FF">§14:</font> Betrug</b></summary>
                <fieldset>
                  <legend><b>Beschreibung:</b></legend>
                  <table>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr1:</font></b></td>
                      <td> Alle Arten von Betrug sind verboten. Dazu gehört ebenfalls das Ausrauben von Clankassen.</td>
                    </tr>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr2:</font></b></td>
                      <td> Bei einem Verstoß wird mit einer Sperre geahndet und Schäden in den meisten Fällen zurückerstattet.</td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                </fieldset>
              </details>
       
          </td>
          <td width="50%" style="vertical-align:top;">
        
              <details>
                <summary><b><font color="0066FF">§15:</font> Ketten-Pms</b></summary>
                <fieldset>
                  <legend><b>Beschreibung:</b></legend>
                  <table>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr1:</font></b></td>
                      <td> Ketten-Pms sind verboten.</td>
                    </tr>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr2:</font></b></td>
                      <td> Das bedeutet ihr dürft die gleiche Pm und den Inhalt nicht an mehrere Personen bzw. an verschiedene Personen schicken und damit spammen. </td>
                    </tr>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr3:</font></b></td>
                      <td> Ausgeschlossen von dieser Regel sind die Clanrundmails.</td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                </fieldset>
              </details>
         
          </td>
        </tr>
        <tr>
          <td width="50%" style="vertical-align:top;">
      
              <details>
                <summary><b><font color="0066FF">§16:</font> Regelverstoß</b></summary>
                <fieldset>
                  <legend><b>Beschreibung:</b></legend>
                  <table>
                    <tr>
                      <td>
                        <b><font color="0066FF">Nr1:</font></b></td>
                      <td> Bei Verdacht auf Regelverstoß, ist jeder User verpflichtet dies umgehend zu melden.</td>
                    </tr>
                    <tr>
                      <td>
                        <b><font color="0066FF">Strafe:</font></b></td>
                      <td> Das Nicht-melden und Unterstützen von Verstößen ist nicht erlaubt und führt zum Ausschluss. </td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                  </table>
                </fieldset>
              </details>
           
          </td>
        </tr>
</table>
<fieldset>
  <legend><b>Anmeldung:</b></legend>
  <table>
    <tr>
      <td>
        <b><font color="0066FF">Nr1:</font></b></td>
      <td> Mit Anmeldung gelten die Regeln als durchgehend akzeptiert.</td>
    </tr>
    <tr>
      <td>
        <b><font color="0066FF">Nr2:</font></b></td>
      <td> Wer gegen die Regeln vorsätzlich oder fahrlässig verstößt, kann mit Verwarnung, Sperrung oder Bann rechnen. </td>
    </tr>
    <tr>
      <td>
        <b><font color="0066FF">Nr3:</font></b></td>
      <td> Dauersperren auf DBBG-Welten gelten für alle anderen Welten und sind nachträglich übertragbar. </td>
    </tr>
    <tr>
      <td>
        <b><font color="0066FF">Nr4:</font></b></td>
      <td> Bei möglichen Missverständnisen oder Anfragen bitte eine Entsperrungsanfrage über das gegebene Feld absenden bzw. beim Support melden. </td>
    </tr>
    <tr>
      <td>
        <b><font color="0066FF">Nr5:</font></b></td>
      <td> Es besteht keinerlei Anspruch auf einen Account in DBBG. DBBG behält sich somit das Recht vor, die Anmeldung für einzelne Personen zu verweigern oder rückgängig zu machen.</td>
    </tr>
    <tr>
      <td></td>
    </tr>
  </table>
</fieldset>
  
     
     
</td></tr>
</table><br><br>  
<?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'bbcode')
{
?>  
 <table width="100%"><tr><td><div class="catGradient borderT borderB"><center><b>BB Code</b></center></div>
 Ist eine an HTML angelehnte, jedoch vereinfachte Form, die durch simple Änderungen des Codes, euch erlauben, Texte in eurer Signatur zu formatieren.<br/> 
Dadurch könnt ihr den Inhalt von einem Text individuell gestalten.<br>
 <center>Folgende Codes stehen euch zur Verfügung<br><br/>
 <b>Dicker Text: [b]Dicker Text[/b]</b><br>
 <u>Unterstrichener Text: [u]Unterstrichener Text[/u]</u><br>
 <i>Kursiver Text: [i]Unterstrichener Text[/i]</i><br>
 Ein Bild anzeigen: [img]URL ZUM BILD[/img]<br>
 Verlinkung: [url=URL LINK]TEXT[/url]<br>
 </center>
</td></tr></table><br><br>    
<?php
}
else if(isset($_GET['info']) && $_GET['info'] == 'impressum')
{
?>  
<div class="spacer"></div>
<table width="100%" cellspacing="0" border="0" style="text-align: center;">
  <tr>
    <td colspan=6 height="20px">
      <div class="SideMenuKat catGradient borderB">
        <div class="schatten">Impressum</div>
      </div>
      <div class="spacer"></div>
    </td>
  </tr>
  <tr>
    <td width="30%">
      <b>E-Mail</b>
    </td>
    <td width="20%">
      <b>Name</b>
    </td>
    <td width="25%">
      <b>Adresse</b>
    </td>
    <td width="25%">
      <b>Angaben</b>
    </td>
  </tr>
  <tr>
    <td width="30%">
      <p><a href="mailto:p-u-r-e@hotmail.de">p-u-r-e@hotmail.de</a>
    </td>
    <td width="20%">
      André Braun
    </td>
    <td width="25%">
      Obergasse 11A<br/>
      55576 Welgesheim
    </td>
    <td width="25%">
      Angaben gemäß § 5 TMG
    </td>
  </tr>
  <tr>
    <td colspan=6 height="20px">
      <hr>
      <b>Haftungsausschluss:</b><br> <b>Haftung für Inhalte</b>
      <div class="spacer"></div>
      Die Inhalte unserer Seiten wurden mit größter Sorgfalt erstellt. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte können wir jedoch keine Gewähr übernehmen. Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen
      Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige
      Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung
      möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.<br>
      <hr>
      <b>Haftung für Links</b><br> Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten
      ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar.
      Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.
      <hr>

      <b>Urheberrecht</b><br> Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes
      bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden,
      werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von
      Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.
      <hr>

      <b>Datenschutz</b><br> Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten möglich. Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, Anschrift oder eMail-Adressen so wie IP Adressen(IP Adressen werden in dem Falle Temporär Gespeichert)) erhoben werden, erfolgt dies,
      soweit möglich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdrückliche Zustimmung nicht an Dritte weitergegeben. Wir weisen darauf hin, dass die Datenübertragung im Internet (z.B. bei der Kommunikation per E-Mail) Sicherheitslücken
      aufweisen kann. Ein lückenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht möglich. Der Nutzung von im Rahmen der Impressumspflicht veröffentlichten Kontaktdaten durch Dritte zur Übersendung von nicht ausdrücklich angeforderter Werbung
      und Informationsmaterialien wird hiermit ausdrücklich widersprochen. Die Betreiber der Seiten behalten sich ausdrücklich rechtliche Schritte im Falle der unverlangten Zusendung von Werbeinformationen, etwa durch Spam-Mails, vor.
      <hr>

      <b>Quelle: Disclaimer von eRecht24, dem Portal zum Internetrecht von Rechtsanwalt Sören Siebert.</b>
      <div class="spacer"></div>
    </td>
  </tr>
</table>
<?php
}
?>  