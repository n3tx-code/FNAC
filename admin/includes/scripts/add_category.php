<?php

include('../../../includes/bdd.php');

var_dump($_POST);
$name = htmlspecialchars($_POST['categorie_name']);

$parent = null;
if(!empty($_POST['categorie_parent']))
    $parent = $_POST['categorie_parent'];

$description = null;
if(!empty($_POST['categorie_description']))
    $description = $_POST['categorie_description'];

$sql = 'INSERT INTO category( name, parent, description) VALUES(:name, :parent, :description)';

$req = $bdd->prepare($sql);
$req->execute(array(
   'name' => $name,
   'parent' => $parent,
   'description' => $description
));

header("Location: /admin/?type=categorie&error=false&name=" . $name);

?>