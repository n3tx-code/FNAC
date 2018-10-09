<?php

include('../includes/bdd.php');

if(!isset($_POST['submit']) OR empty($_POST['submit']))
{
    header('location: ../test.php');
}

$sql = 'SELECT COUNT(*) FROM partner';
$result = $bdd->query($sql);

$id = $result->fetchColumn(0);
$name = $_POST['name'];
$parent = ""; //?
$description = $_POST['description'];

$sql = "";

$req = $bdd->prepare($sql);
$req->execute(array(
   'id' => $id,
   'name' => $name,
   'parent' => $parent,
   'description' => $description
));

?>