<?php
require_once 'stringparser_bbcode.class.php';
$serverUrlFile = 'classes/serverurl.php';
if (file_exists($serverUrlFile))
{
  include_once $serverUrlFile;
}
// Zeilenumbrche verschiedener Betriebsysteme vereinheitlichen
function convertlinebreaks ($text) {
return preg_replace ("/\015\012|\015|\012/", "\n", $text);
}
// Alles bis auf Neuezeile-Zeichen entfernen
function bbcode_stripcontents ($text) {
return preg_replace ("/[^\n]/", '', $text);
}
function do_bbcode_ref ($action, $attributes, $content, $params, $node_object) {
if (!isset ($attributes['default'])) {
$url = $content;
$text = htmlspecialchars ($content);
} else {
$url = $attributes['default'];
$text = $content;
}
if ($action == 'validate') {
if (substr ($url, 0, 5) == 'data:' || substr ($url, 0, 5) == 'file:'
|| substr ($url, 0, 11) == 'javascript:' || substr ($url, 0, 4) == 'jar:') {
return false;
}
return true;
}
return '<b><a href="?p=verzeichnis&name='.htmlspecialchars ($url).'">'.$text.'</a></b>';
}
function do_bbcode_url ($action, $attributes, $content, $params, $node_object) {
if (!isset ($attributes['default'])) {
$url = $content;
$text = htmlspecialchars ($content);
} else {
$url = $attributes['default'];
$text = $content;
}
if ($action == 'validate') {
if (substr ($url, 0, 5) == 'data:' || substr ($url, 0, 5) == 'file:'
|| substr ($url, 0, 11) == 'javascript:' || substr ($url, 0, 4) == 'jar:') {
return false;
}
return true;
}
return '<a href="'.htmlspecialchars ($url).'">'.$text.'</a>';
}
function do_bbcode_anker ($action, $attributes, $content, $params, $node_object) {
    if (!isset ($attributes['default'])) {
        $url = $content;
        $text = htmlspecialchars ($content);
    } else {
        $url = $attributes['default'];
        $text = $content;
    }
    if ($action == 'validate') {
        if (substr ($url, 0, 5) == 'data:' || substr ($url, 0, 5) == 'file:'
          || substr ($url, 0, 11) == 'javascript:' || substr ($url, 0, 4) == 'jar:') {
            return false;
        }
        return true;
    }
    return '<a title="dragonball,browsergame" id="'.$url.'">'.$text.'</a>';
}
// Funktion zum Einbinden von Bildern
function do_bbcode_img ($action, $attributes, $content, $params, $node_object) 
{
global $serverUrl;
if ($action == 'validate') {
if (substr ($content, 0, 5) == 'data:' || substr ($content, 0, 5) == 'file:'
|| substr ($content, 0, 11) == 'javascript:' || substr ($content, 0, 4) == 'jar:') {
return false;
}
return true;
}
$returnString = '<img title="dragonball,browsergame" alt="dragonball,browsergame" src="img.php?url='.htmlspecialchars($content).'"';
$urlLength = strlen($serverUrl);
if(substr($content,0,$urlLength) == $serverUrl)
{
  $returnString = '<img title="dragonball,browsergame" alt="dragonball,browsergame" src="'.htmlspecialchars($content).'"';
}
if(isset($attributes['width']) && is_numeric($attributes['width']))
{
  $returnString = $returnString.' width="'.$attributes['width'].'"';
}
if(isset($attributes['height']) && is_numeric($attributes['height']))
{
  $returnString = $returnString.' height="'.$attributes['height'].'"';
}
  
$returnString = $returnString.' alt ="">';
return $returnString;
}

function do_bbcode_color ($action, $attributes, $content, $params, $node_object) {
if ($action == 'validate') {
return true;
}
return "<span style=\"color: {$attributes['default']}\">$content</span>";
}
$bbcode = new StringParser_BBCode ();                               
$bbcode->addParser (array ('block', 'inline', 'link', 'listitem'), 'htmlspecialchars');
$bbcode->addParser (array ('block', 'inline', 'link', 'listitem'), 'nl2br');
$bbcode->addParser ('list', 'bbcode_stripcontents');
$bbcode->addCode ('b', 'simple_replace', null, array ('start_tag' => '<b>', 'end_tag' => '</b>'),
'inline', array ('listitem', 'block', 'inline', 'link'), array ());
$bbcode->addCode ('strike', 'simple_replace', null, array ('start_tag' => '<strike>', 'end_tag' => '</strike>'),
'inline', array ('listitem', 'block', 'inline', 'link'), array ());
$bbcode->addCode ('s', 'simple_replace', null, array ('start_tag' => '<strike>', 'end_tag' => '</strike>'),
'inline', array ('listitem', 'block', 'inline', 'link'), array ());
$bbcode->addCode ('center', 'simple_replace', null, array ('start_tag' => '<center>', 'end_tag' => '</center>'),
'inline', array ('listitem', 'block', 'inline', 'link'), array ());
$bbcode->addCode ('u', 'simple_replace', null, array ('start_tag' => '<u>', 'end_tag' => '</u>'),
'inline', array ('listitem', 'block', 'inline', 'link'), array ());
$bbcode->addCode ('i', 'simple_replace', null, array ('start_tag' => '<i>', 'end_tag' => '</i>'),
'inline', array ('listitem', 'block', 'inline', 'link'), array ());
$bbcode->addCode ('url', 'usecontent?', 'do_bbcode_url', array ('usecontent_param' => 'default'),
'link', array ('listitem', 'block', 'inline'), array ('link'));    
$bbcode->addCode ('ref', 'usecontent?', 'do_bbcode_ref', array ('usecontent_param' => 'default'),
'link', array ('listitem', 'block', 'inline'), array ('link'));    
$bbcode->addCode ('a', 'usecontent?', 'do_bbcode_anker', array ('usecontent_param' => 'default'),
                  'link', array ('listitem', 'block', 'inline'), array ('link'));
$bbcode->addCode ('link', 'callback_replace_single', 'do_bbcode_url', array (),
'link', array ('listitem', 'block', 'inline'), array ('link'));
$bbcode->addCode ('img', 'usecontent', 'do_bbcode_img', array (),
'image', array ('listitem', 'block', 'inline', 'link'), array ());
$bbcode->addCode ('bild', 'usecontent', 'do_bbcode_img', array (),
'image', array ('listitem', 'block', 'inline', 'link'), array ());
$bbcode->addCode (
'color',
'callback_replace',
'do_bbcode_color',
array('usecontent_param' => array ('default')),
'inline',
array ('listitem', 'block', 'inline', 'link'),
array ());
$bbcode->setCodeFlag ('color', 'closetag', BBCODE_CLOSETAG_MUSTEXIST);
$bbcode->addCode ('youtube', 'simple_replace', null, array ('start_tag' => '<embed pluginspage="http://www.macromedia.com/go/getflashplayer" src="http://www.youtube.com/v/', 'end_tag' => '" width="400" height="300" type="application/x-shockwave-flash" wmode="transparent" quality="high" scale="exactfit"></embed>'), 'inline', array ('listitem', 'block', 'inline', 'link', 'quote', 'pre', 'monospace'), array ());
$bbcode->setOccurrenceType ('img', 'image');
$bbcode->setOccurrenceType ('bild', 'image');
$bbcode->setMaxOccurrences ('image', 30);
$bbcode->addCode ('list', 'simple_replace', null, array ('start_tag' => '<ul>', 'end_tag' => '</ul>'),
'list', array ('block', 'listitem'), array ());
$bbcode->addCode ('*', 'simple_replace', null, array ('start_tag' => '<li>', 'end_tag' => '</li>'),
'listitem', array ('list'), array ());
$bbcode->setCodeFlag ('*', 'closetag', BBCODE_CLOSETAG_OPTIONAL);
$bbcode->setCodeFlag ('*', 'paragraphs', true);
$bbcode->setCodeFlag ('list', 'paragraph_type', BBCODE_PARAGRAPH_BLOCK_ELEMENT);
$bbcode->setCodeFlag ('list', 'opentag.before.newline', BBCODE_NEWLINE_DROP);
$bbcode->setCodeFlag ('list', 'closetag.before.newline', BBCODE_NEWLINE_DROP);
$bbcode->setRootParagraphHandling (true);
?>