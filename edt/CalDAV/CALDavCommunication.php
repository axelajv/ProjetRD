<?php

require 'vendor/php-curl-class/php-curl-class/src/Curl/Curl.php';
use \Curl\Curl;

$ENSEIGNANT = "Enseignants";
$ETUDIANT = "Etudiants";
$FILIERE = "Filieres";
$SALLE = "Salles";

define("URL_LOCALE", "http://localhost:5232");
define("URL_RADICALE", "http://compri.me:5232");

function sendICSFile($nomfichier, $contenu, $ctg){

    $url = '/' . $ctg . '/' . $nomfichier . '/';
    $userpwd = 'adminprof:adminprof';

    $headers = array(
        'Content-Type: text/calendar; charset=utf-8',
        'If-None-Match: *',
        'Content-Length: ' . strlen($contenu)
    );

    $curl = new Curl();
    $curl->PUT(URL_RADICALE . $url, $headers, $contenu, $userpwd);
    $retour = getStatusInfo($curl, $nomfichier);

    writeLog($retour, 'cURL', 'PUT');
}

function getStatusInfo($curl, $nomfichier, $httpStatus = array(200,201,202,203,204,205,206,207,210)) {
    $msg = array();

    // requete
    if(!$curl->curl_error) {
        if( in_array($curl->http_status_code, $httpStatus) ) {
            $msg = "La requête est bien arrivée - HTTP[" . $curl->http_status_code . "] Le fichier \"" . $nomfichier . "\" a été envoyé au serveur";
        } else {
            $msg = "La requête a échoué - HTTP[".$curl->http_status_code."] Le fichier \"".$nomfichier."\" n'a pas été envoyé au serveur";
        }
    } else {
        $msg = "cURL KO, erreur : ".$curl->curl_error_message;
    }
    return $msg;
}

function writeLog($msg, $subject, $type) {
    $monfichier = fopen('../CALDav/log.txt', 'a+');
    fputs($monfichier, date('dmY-H:i')." [".$subject." - ".$type."] - ".$msg.";\n");
    fclose($monfichier);

    //si le fichier devient trop gros, on l'efface
    if(filesize('../CALDav/log.txt') > 500000){
        $vide = fopen('../CALDav/log.txt', 'w');
        fclose($vide);
    }
}