<?php

// cURL : Client URL Request Library
$ch = curl_init(); // début transaction

curl_setopt($ch, CURLOPT_URL,"http://5.196.11.220:5232/calendar/"); // URL sollicitée
curl_setopt($ch, CURLOPT_POST, 1); // POST
curl_setopt($ch, CURLOPT_POSTFIELDS, "postvar1=value1&postvar2=value2"); // paramètres
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// réponse du serveur
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch); // fin transaction

if ($server_output == "OK") {
    /* OK */
    echo "OK";
} else {
    /* KO */
    echo "KO";
}