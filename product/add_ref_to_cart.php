<?php
session_start();
var_dump($_POST);
if(isset($_POST['amount']) AND isset($_POST['ref']) AND isset($_POST['ref_shop']))
{
    $amount = intval($_POST['amount']);
    $ref = intval($_POST['ref']);
    $shop = $_POST['ref_shop'];
    $_SESSION['cart'][$ref] += $amount;
    $_SESSION['cart'][$ref]['shop'] = $shop;
    header('location: ' . $_SERVER['HTTP_REFERER'] . '&add=' . $amount);
}
else
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}
?>