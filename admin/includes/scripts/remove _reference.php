<?php

if(!isset($_POST['reference']) OR empty($_POST['reference']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

$reference = $_POST['reference'];

$sql = 'DELETE * FROM reference WHERE id = ' . $reference;
$bdd->query($sql);

echo "Successfully removed !";

?>