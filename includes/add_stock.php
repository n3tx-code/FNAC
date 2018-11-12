<?php

include('bdd.php');

if(!isset($_POST['shop']) OR empty($_POST['shop']) OR !isset($_POST['reference']) OR empty($_POST['reference'])
    OR !isset($_POST['quantity']) OR empty($_POST['quantity']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

$shop = $_POST['shop'];
$reference = $_POST['reference'];
$quantity = $_POST['quantity'];

$sql = 'INSERT INTO stock(shop, reference, quantity) VALUES (:shop, :reference, :quantity)';

$req = $bdd->prepare($sql);
$req->execute(array(
    'shop' => $shop,
    'reference' => $reference,
    'quantity' => $quantity
));

echo 'Succesfully added !';

?>