<?php

// URL A PARAMETRER
require 'vendor/autoload.php';
use \Curl\Curl;

$ENSEIGNANT = "Enseignants";
$ETUDIANT = "Etudiants";
$FILIERE = "Filieres";
$SALLE = "Salles";

function sendICSFile($nomfichier,$contenu,$categorie,$uid){

    $url = $categorie.'/'.$nomfichier.'/';
    $userpwd = 'adminprof:adminprof';

    $headers = array(
        'Content-Type: text/calendar; charset=utf-8',
        'If-None-Match: *',
        'Content-Length: '.strlen($contenu),
    );

    echo $contenu."<br/><br/>";

    $curl = new Curl();

    $curl->PUT('https://edouardalvescamilo.ovh/'.$url,$headers, $contenu, $userpwd);

    $retour = getStatusInfo($curl);

    writeLog($retour,'cURL');
}

function getStatusInfo($curl, $httpStatus = array(200,201,202,203,204,205,206,207,210)) {
    $msg = array();

    // requete
    if(!$curl->curl_error) {
        if( in_array($curl->http_status_code, $httpStatus) ) {
            $msg = "La requête est bien arrivée - HTTP[".$curl->http_status_code."]".$curl->response_headers;
        } else {
            $msg = "La requête a échoué - HTTP[".$curl->http_status_code."]".$curl->response_headers;
        }
    } else {
        $msg = "cURL KO, erreur : ".$curl->curl_error_message;
    }

    return $msg;
}

function writeLog($msg,$subject){
    $monfichier = fopen('log_CalDAVCommunication.txt', 'a+');
    fputs($monfichier, date('dmY-H:i')." [".$subject."] - ".$msg.";\n");
    fclose($monfichier);

    //si le fichier devient trop gros, on l'efface
    if(filesize('log_CalDAVCommunication.txt') > 3000000){
        $vide = fopen('log_CalDAVCommunication.txt', 'w');
        fclose($vide);
    }
}
?>
