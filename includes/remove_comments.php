<?php

include('bdd.php');

if(!isset($_SESSION['id']) OR empty($_SESSION['id']) OR !isset($_POST['reference']) OR empty($_POST['reference']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

$client = $_SESSION['id'];
$reference = $_POST['reference'];

$sql = 'DELETE FROM opinion WHERE client = :client AND reference = :reference';
$req = $bdd->prepare($sql);
$req->execute(array(
    'client' => $client,
    'reference' => $reference
));

echo "Successfully removed !";

?>