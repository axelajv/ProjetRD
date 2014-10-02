<?php
require '../vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();
$curl->head('http://www.indydedeken.fr');

if(!$curl->curl_error) {
    if($curl->http_status_code == 200) {
        echo "La requête est bien arrivée";
    } else {
        echo "La requête a échoué";
    }
} else {
    echo "cURL non lancée";
}

echo "<br><hr><br>";

// affiche le contenu de la réponse cURL
var_dump($curl);