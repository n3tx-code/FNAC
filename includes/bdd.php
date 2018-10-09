<?php
$bdd = new PDO("mysql:dbname=fnac;host:localhost;charset=utf8", 'root', '',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
?>