<?php

$url = 'http://localhost:5232/R&D/Nicolas/';
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PROPFIND'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLINFO_HEADER_OUT, true); 


$response = curl_exec($ch); 

$status = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
$headerOut = curl_getinfo($ch, CURLINFO_HEADER_OUT); 

echo "[Status: ".$status."]<br/>[Header out : ".$headerOut."]<br/>[Reponse: ".$response."]"; 

curl_close($ch); 

?>