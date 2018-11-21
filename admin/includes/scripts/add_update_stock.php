<?php
if(!isset($_POST['id_shop']) OR empty($_POST['id_shop']) OR !isset($_POST['ref_stock']) OR empty($_POST['ref_stock'])
    OR !isset($_POST['stock_number']) OR empty($_POST['stock_number']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

include('../../../includes/bdd.php');

$shop = $_POST['id_shop'];
$reference = $_POST['ref_stock'];
$quantity = $_POST['stock_number'];

$sql = 'INSERT INTO stock(shop, reference, quantity) VALUES (:shop, :reference, :quantity)
ON DUPLICATE KEY UPDATE quantity = :quantity';

$req = $bdd->prepare($sql);
$req->execute(array(
    'shop' => $shop,
    'reference' => $reference,
    'quantity' => $quantity
));

header("Location: /admin/?type=stock&error=false&name=none" );
?>