<?php
include('../../../includes/bdd.php');

$name = htmlspecialchars($_POST['product_name']);
$ref_product = htmlspecialchars($_POST['product_ref']);
$partner = (isset($_POST['product_partner']) AND !empty($_POST['product_partner'])) ? $_POST['product_partner'] : null;
$category = htmlspecialchars($_POST['product_cat']);
$description = htmlspecialchars($_POST['product_description']);
$price = intval((htmlspecialchars($_POST['product_price'])));

$sql = 'INSERT INTO reference(category, partner, ref_product, name, description, price) 
VALUES(:category, :partner, :ref_product, :name, :description, :price)';

$req = $bdd->prepare($sql);
$req->execute(array(
    'category' => $category,
    'partner' => $partner,
    'ref_product' => $ref_product,
    'name' => $name,
    'description' => $description,
    'price' => $price
));

header("Location: /admin/?type=product&error=false&name=" . $name);

?>