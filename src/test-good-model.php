<?php
require '../vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();
$curl->head('http://www.indydedeken.fr');

if(!$curl->curl_error) {
    if($curl->http_status_code == 200) {
        echo "La requ�te est bien arriv�e";
    } else {
        echo "La requ�te a �chou�";
    }
} else {
    echo "cURL non lanc�e";
}

echo "<br><hr><br>";

// affiche le contenu de la r�ponse cURL
var_dump($curl);