<?php

/*
 * Permet de délogger un utilisateur
 * et le rediriger vers index.php?page=agendas_ics_login
 */

session_start();

error_reporting(E_ALL);

unset($_SESSION['teachLoginAgendasICS']);

exit();

?>
