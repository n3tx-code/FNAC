<?php

include('../includes/bdd.php');

if(!isset($_POST['submit']) OR empty($_POST['submit']))
{
    header('location: ../test.php');
}

?>