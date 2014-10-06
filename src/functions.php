<?php

/**
 * @param $curl
 * @param array $httpStatus
 * @return array
 */
function publishBehavior($curl, $httpStatus = array(200)) {

    $behavior = array();

    // requete
    if(!$curl->curl_error) {
        if( in_array($curl->http_status_code, $httpStatus) ) {
            $behavior['requete'] = "La requ�te est bien arriv�e";
        } else {
            $behavior['requete'] = "La requ�te a �chou�";
        }
    } else {
        $behavior['requete'] = "cURL KO, erreur : ".$curl->curl_error;
    }

    // contenu de la requete
    if($behavior['requete'] != "cURL KO") {

        $behavior['contenu'] = "<pre>";
        $behavior['contenu'] .= print_r($curl, true);
        $behavior['contenu'] .= "</pre>";

    }

    return $behavior;
}
