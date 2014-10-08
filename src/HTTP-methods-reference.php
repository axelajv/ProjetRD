<?php

// Chargement des dépendances (composer)
require '../vendor/autoload.php';
require_once 'functions.php';

use \Curl\Curl;

$server     = 'http://localhost';   // serveur utilisé
$collection	= '';    			    // collection utilisée
$calendar   = 'm1g2';               // calendrier utilisé
?>

<?php
//
// Cinquième objet BIS : PUT (à partir d'un fichier)
//
$uid			= "nuckCalendar"; 		// setting this to an existing uid updates event, a new uid adds event
$url			= "nuck/$uid.ics";		// http://mail.domain.com/calendars/DOMAIN/USER/Calendar/'.$uid.'.ics'
$userpwd 		= 'NMA:NMA';
$description	= 'Description ici';
$summary		= 'Essai avec autre compte';
$tstart			= '201410015T000000Z';
$tend			= '20141016T000000Z';
$tstamp			= gmdate("Ymd\THis\Z");

$body = "";

// 1 : on ouvre le fichier
$monfichier = fopen('Essai-import.ics', 'r+');

// 2 : on lit la première ligne du fichier
while($ligne = fgets($monfichier)){
	$body = $body . $ligne . "\n";
}

$headers = array(
	'Content-Type: text/calendar; charset=utf-8',
	'If-None-Match: *',
	'Expect: ',
	'Content-Length: '.strlen($body),
);

if(true) { // active/desactive l'execution de la requete
	$curl = new Curl();
	$curl->PUT("$server:5232/" . $url, $headers, $body, $userpwd); // --> juste adresse du serveur

	$test5bis = publishBehavior($curl, $data);
	echo "<h1>Objet 5 bis : PUT (à partir d'un fichier)</h1>";
	echo $test5bis['requete'];
	echo $test5bis['contenu'];
	
	unset($curl);
}
// 
// Fin cinquième objet BIS : PUT (à partir d'un fichier)
//
?>


<?php
//
// Cinquième objet cURL : PUT
//
$uid			= "nuckCalendar"; 		// setting this to an existing uid updates event, a new uid adds event
$url			= "nuck/$uid.ics";		// http://mail.domain.com/calendars/DOMAIN/USER/Calendar/'.$uid.'.ics'
$userpwd 		= 'NMA:NMA';
$description	= 'Description ici';
$summary		= 'Essai avec autre compte';
$tstart			= '201410015T000000Z';
$tend			= '20141016T000000Z';
$tstamp			= gmdate("Ymd\THis\Z");

$body = <<<__EOD
BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
DTSTAMP:$tstamp
DTSTART:$tstart
DTEND:$tend
UID:$uid
DESCRIPTION:$description
LOCATION:Office
SUMMARY:$summary
END:VEVENT
END:VCALENDAR
__EOD;

$headers = array(
	'Content-Type: text/calendar; charset=utf-8',
	'If-None-Match: *',
	'Expect: ',
	'Content-Length: '.strlen($body),
);

if(false) { // active/desactive l'execution de la requete
	$curl = new Curl();
	$curl->PUT("$server:5232/" . $url, $headers, $body, $userpwd); // --> juste adresse du serveur

	$test5 = publishBehavior($curl, $data);
	echo "<h1>Objet 5 : PUT</h1>";
	echo $test5['requete'];
	echo $test5['contenu'];
	
	unset($curl);
}
//
// Fin cinquième objet cURL : PUT
//
?>

<hr>

<?php
//
// Quatrième objet cURL : PROPFIND
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
$curl->propfind("$server:5232/$collection/$calendar/", $body);

$test4 = publishBehavior($curl, $data);
echo "<h1>OBJET 4 : PROPFIND</h1>";
echo $test4['requete'];
echo $test4['contenu'];

unset($curl);
//
// Fin quatrième objet cURL : PROPFIND
//
?>

<hr>

<?php
//
// Troisième objet cURL : HEAD
//
$curl = new Curl();
$curl->head("$server:5232/$collection/$calendar/");
$data = array(200);

$test3 = publishBehavior($curl, $data);
echo "<h1>OBJET 3 : HEAD</h1>";
echo $test3['requete'];
echo $test3['contenu'];

unset($curl);
//
// Fin troisième objet cURL : HEAD
//
?>

<hr>

<?php
//
// Second objet cURL : GET
//
$curl = new Curl();
$curl->get("$server:5232/$collection/$calendar/");
$data = array(200, 201, 207);

$test2 = publishBehavior($curl, $data);
echo "<h1>OBJET 2 : GET</h1>";
echo $test2['requete'];
echo $test2['contenu'];

unset($curl);
//
// Fin second objet cURL : GET
//
?>

<hr>

<?php
//
// Premier objet cURL : OPTIONS
//
$curl = new Curl();
$curl->options("$server:5232/$collection/$calendar/");
$data = array(200); // http status

$test1 = publishBehavior($curl, $data);
echo "<h1>OBJET 1 : OPTIONS</h1>";
echo $test1['requete'];
echo $test1['contenu'];

unset($curl);
//
// Fin premier objet cURL : OPTIONS
//
?>

<?php
// NE PAS FERMER LA BALISE PHP : <?php
