<?php

include('../../../includes/bdd.php');

if(!isset($_POST['shop_nom']) OR empty($_POST['shop_nom']) OR !isset($_POST['shop-n-rue'])
    OR empty($_POST['shop-n-rue']) OR !isset($_POST['shop-rue']) OR empty($_POST['shop-rue'])
    OR !isset($_POST['shop-ville']) OR empty($_POST['shop-ville']) OR
    !isset($_POST['shop-CP']) OR empty($_POST['shop-CP']))
{
    header('location: ' . $_SERVER['HTTP_REFERER'] . "?type=shop&error=missing&name=none");
}

$identifiant = $_POST['shop_nom'];
$street_number = $_POST['shop-n-rue'];
$street = $_POST['shop-rue'];
$city = $_POST['shop-ville'];
$zip_code = $_POST['shop-CP'];

$sql = 'INSERT INTO shop(identifiant, street_number, street, city, zip_code) VALUES (:identifiant, :street_number, :street, :city, :zip_code)';

$req = $bdd->prepare($sql);
$req->execute(array(
    'identifiant' => $identifiant,
    'street_number' => $street_number,
    'street' => $street,
    'city' => $city,
    'zip_code' => $zip_code
));

header("Location: /admin/?type=shop&error=false&name=" . $identifiant);

?>