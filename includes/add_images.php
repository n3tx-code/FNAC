<?php

include('bdd.php');

if(!isset($_POST['reference']) OR empty($_POST['reference']) OR !isset($_POST['urls']) OR empty($_POST['urls']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

$reference = $_POST['reference'];
$urls = $_POST['urls']; //its an array

foreach ($urls as $url)
{
    $sql = 'INSERT INTO image(reference, src) VALUES(:reference, :url)';

    $req = $bdd->prepare($sql);
    $req->execute(array(
        'reference' => $reference,
        'url' => $url
    ));
}

?>