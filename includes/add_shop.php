<?php

include('bdd.php');

if(!isset($_POST['identifiant']) OR empty($_POST['identifiant']) OR !isset($_POST['street_number']) OR empty($_POST['street_number'])
    OR !isset($_POST['street']) OR empty($_POST['street']) OR !isset($_POST['city']) OR empty($_POST['city']) OR
    !isset($_POST['zip_code']) OR empty($_POST['zip_code']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

$identifiant = $_POST['identifiant'];
$street_number = $_POST['street_number'];
$street = $_POST['street'];
$city = $_POST['city'];
$zip_code = $_POST['zip_code'];

$sql = 'INSERT INTO shop(identifiant, street_number, street, city, zip_code) VALUES (:identifiant, :street_number, :street, :city, :zip_code)';

$req = $bdd->prepare($sql);
$req->execute(array(
    'identifiant' => $identifiant,
    'street_number' => $street_number,
    'street' => $street,
    'city' => $city,
    'zip_code' => $zip_code
));

echo 'Succesfully added !';

?>