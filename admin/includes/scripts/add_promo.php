<?php

include('../includes/bdd.php');

if(!isset($_POST['submit']) OR empty($_POST['submit']))
{
    header('location: ../test.php');
}

$reference = $_POST['reference']; //recover the id
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$percentage = $_POST['percentage'];

$sql = "INSERT INTO promo(reference, start_date, end_date, percentage) VALUES(:reference, :start_date, :end_date, :percentage)";

$req = $bdd->prepare($sql);
$req->execute(array(
   'reference' => $reference,
   'start_date' => $start_date,
   'end_date' => $end_date,
   'percentage' => $percentage
));

echo 'Successfully added !';

?>