<?php
session_start();
$_SESSION[] = array(); /* efface le contenue de la variable de sessions */
session_destroy();
header("Location: /profil/login/");
?>