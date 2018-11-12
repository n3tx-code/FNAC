<?php

include('../../../includes/bdd.php');

$name = htmlspecialchars($_POST['partner_name']);
$description = htmlspecialchars($_POST['partner_description']);
$website = htmlspecialchars($_POST['partner_site']);

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

    header("Location: /admin/?type=partner&error=false&name=" . $name);
}
else
{
    echo 'Invalid url !';
}






?>