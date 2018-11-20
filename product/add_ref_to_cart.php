<?php
session_start();
if(isset($_POST['amount']) AND isset($_POST['ref']))
{
    $amount = intval($_POST['amount']);
    $ref = intval($_POST['ref']);
    $_SESSION['cart'][$ref] += $amount;
    header('location: ' . $_SERVER['HTTP_REFERER'] . '&add=' . $amount);
}
else
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}
?>