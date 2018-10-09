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
$description = $_POST['description'];
$website = $_POST['site'];

$sql = 'INSERT INTO partner(id, name, description, website) VALUES(:id, :name, :description, :website)';

if(filter_var($website, FILTER_VALIDATE_URL))
{
    $req = $bdd->prepare($sql);
    $req->execute(array(
       'id' => $id,
       'name' => $name,
       'description' => $description,
       'website' => $website
    ));

    echo 'Partner added !';
}
else
{
    echo 'Invalid url !';
}



?>