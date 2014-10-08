
<?php

require '../vendor/autoload.php';
require_once 'functions.php';

use \Curl\Curl;


$uid = "nuckCalendar"; // setting this to an existing uid updates event, a new uid adds event
$url = 'nuck'.'/'.$uid.'.ics'; //http://mail.domain.com/calendars/DOMAIN/USER/Calendar/'.$uid.'.ics'
$userpwd = 'NMA:NMA';
$description = 'Description ici';
$summary = 'Essai avec autre compte';
$tstart = '201410015T000000Z';
$tend = '20141016T000000Z';
$tstamp = gmdate("Ymd\THis\Z");



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


//
// Second objet cURL : PROPFIND
//
$curl = new Curl();

//$data = array(200, 207);
//$curl->propfind('http://compri.me:5232/radicale/',$body);
$curl->PUT('http://localhost:5232/'.$url,$headers, $body, $userpwd); // --> juste adresse du serveur

$test4 = publishBehavior($curl, $data);
echo "<h1>TEST DE PUT(e)</h1>";
echo $test4['requete'];
echo '<br/>----------';
echo $test4['contenu'];
//
// Fin second objet cURL : PROPFIND
//
unset($curl);
?>
