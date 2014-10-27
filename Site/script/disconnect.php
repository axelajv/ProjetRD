<?php

//suppression des variables de sessions
if (isset ($_SESSION['teachLogin']) || isset($_SESSION['studyLogin']))
{
	session_destroy();
}
?>
