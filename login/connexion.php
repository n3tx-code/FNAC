<?php

if(!isset($_POST['validation']))
{
    header('Location: index.php');
}
else
{
    include('../includes/bdd.php');
}

?>