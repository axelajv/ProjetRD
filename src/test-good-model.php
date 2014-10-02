<?php
require '../vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();
$curl->propfind('http://compri.me:5232/radicale/');



if(!$curl->curl_error) {
    if( in_array($curl->http_status_code, array(200, 207)) ) {
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