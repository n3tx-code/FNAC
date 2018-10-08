<?php

session_start();

if(!isset($_SESSION['']) OR empty($_SESSION[''])) //add session handling
{
    header('Location: ../index.php');
}



?>