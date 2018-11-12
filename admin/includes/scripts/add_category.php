<?php

include('../includes/bdd.php');

if(!isset($_POST['submit']) OR empty($_POST['submit']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

$sql = 'SELECT COUNT(*) FROM category';
$result = $bdd->query($sql);
$id = $result->fetchColumn();

$name = $_POST['name'];

$parent = null;
if(isset($_POST['parent']) AND !empty($_POST['parent']))
    $parent = $_POST['parent'];

$description = null;
if(isset($_POST['description']) AND !empty($_POST['description']))
    $description = $_POST['description'];

$sql = 'INSERT INTO category(id, name, parent, description) VALUES(:id, :name, :parent, :description)';

$req = $bdd->prepare($sql);
$req->execute(array(
   'id' => $id,
   'name' => $name,
   'parent' => $parent,
   'description' => $description
));

echo "Successfully added !";

?>