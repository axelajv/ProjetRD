<?php
require '../vendor/autoload.php';

use \Curl\Curl;

$curl = new Curl();
$curl->get('http://5.196.11.220:5232/calendar/',
    array('param1' => 'value1', 'param2' => 'value2')
);

// voir comment on récupère le retour...