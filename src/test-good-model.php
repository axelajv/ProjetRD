<?php
require '../vendor/autoload.php';
require_once 'functions.php';

use \Curl\Curl;

/*
 * Paramétrage initial
 */
$server     = 'http://compri.me';   // serveur utilisé
$user       = 'indy:indy';          // user utilisé
$calendar   = 'm1g2';               // calendrier utilisé

//
// Premier objet cURL : OPTIONS
//
$curl = new Curl();
$curl->options("$server:5232/$user/$calendar/");
$data = array(200); // http status

$test1 = publishBehavior($curl, $data);
echo "<h1>OBJET 1 : OPTIONS</h1>";
echo $test1['requete'];
echo $test1['contenu'];
//
// Fin premier objet cURL : OPTIONS
//
unset($curl);
?>

<hr>

<?php
//
// Second objet cURL : GET
//
$curl = new Curl();
$curl->get("$server:5232/$user/$calendar/");
$data = array(200, 201, 207);

$test2 = publishBehavior($curl, $data);
echo "<h1>OBJET 2 : GET</h1>";
echo $test2['requete'];
echo $test2['contenu'];
//
// Fin second objet cURL : GET
//
unset($curl);
?>

<hr>

<?php
//
// Second objet cURL : HEAD
//
$curl = new Curl();
$curl->head("$server:5232/$user/$calendar/");
$data = array(200);

$test3 = publishBehavior($curl, $data);
echo "<h1>OBJET 3 : HEAD</h1>";
echo $test3['requete'];
echo $test3['contenu'];
//
// Fin second objet cURL : HEAD
//
unset($curl);
?>

<hr>

<?php
//
// Second objet cURL : PROPFIND
//
$curl = new Curl();

$body = <<<__EOD
<d:propfind xmlns:d="DAV:" xmlns:c="urn:ietf:params:xml:ns:caldav">
  <d:prop>
   <d:displayname/>
   <d:owner/>
   <d:getetag/>
   <d:principal-URL/>
  </d:prop>
</d:propfind>
__EOD;

$data = array(200, 207);
$curl->propfind("$server:5232/$user/$calendar/", $body);

$test4 = publishBehavior($curl, $data);
echo "<h1>OBJET 3 : PROPFIND</h1>";
echo $test4['requete'];
echo $test4['contenu'];
//
// Fin second objet cURL : PROPFIND
//
unset($curl);
?>


<?php
// NE PAS FERMER LA BALISE PHP : <?php
