<?php

include('../includes/bdd.php');

if(!isset($_POST['submit']) OR empty($_POST['submit']))
{
    header('location: ../test.php');
}

$sql = 'SELECT COUNT(*) FROM reference';
$result = $bdd->query($sql);
$id = $result->fetchColumn();

$name = $_POST['name'];
$ref_product = $_POST['ref_product'];
$partner = (isset($_POST['partner']) AND !empty($_POST['partner'])) ? $_POST['partner'] : null;
$category = $_POST['category'];
$description = $_POST['description'];
$price = $_POST['price'];

//handle promo

$sql = 'INSERT INTO reference(id, category, partner, ref_product, name, description, price) 
VALUES(:id, :category, :partner, :ref_product, :name, :description, :price)';

$req = $bdd->prepare($sql);
$req->execute(array(
    'id' => $id,
    'category' => $category,
    'partner' => $partner,
    'ref_product' => $ref_product,
    'name' => $name,
    'description' => $description,
    'price' => $price
));

echo "Successfully added !";

?>