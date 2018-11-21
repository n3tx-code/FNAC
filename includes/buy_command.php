<?php

if(!isset($_POST['amount']) OR empty($_POST['amount']) OR !isset($_POST['reference']) OR empty($_POST['reference'])
    OR !isset($_POST['price']) OR empty($_POST['price']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

session_start();

include('bdd.php');

$amount = $_POST['amount']; // array of reference amount
$reference = $_POST['reference']; //array of reference id
$client = $_SESSION['id']; // client id
$price = $_POST['price']; //total price

$sql = 'INSERT INTO command(client, price) VALUES(:client, :price)';
$req = $bdd->prepare($sql);
$req->execute(array(
    'client' => $client,
    'price' => $price
));

$command = $bdd->lastInsertId();

try {
    $bdd->beginTransaction();

    for ($i = 0; $i < count($reference); $i++)
    {
        for ($j = 0; $j < count($amount[$i]); $j++)
        {
            $sql = 'INSERT INTO product(reference, command) VALUES(:reference, :command)';
            $req = $bdd->prepare($sql);
            $req->execute(array(
                'reference' => $reference[$i],
                'command' => $command
            ));
        }
    }

    $bdd->commit();
}
catch (Exception $ex)
{
    $bdd->rollBack();

    $sql = 'DELETE FROM command WHERE id = :id';
    $req = $bdd->prepare($sql);
    $req->execute(array(
       'id' => $command
    ));

    exit();
}

echo "done";

?>