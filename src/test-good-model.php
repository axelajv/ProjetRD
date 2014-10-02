<?php
require '../vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();
$curl->propfind('http://compri.me:5232/radicale/');



if(!$curl->curl_error) {
    if( in_array($curl->http_status_code, array(200, 207)) ) {
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