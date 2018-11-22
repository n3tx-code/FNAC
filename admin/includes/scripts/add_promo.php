<?php

include('../../../includes/bdd.php');
$reference = $_POST['ref_promo'];
$start_date = $_POST['promo_start_date'];
$end_date = $_POST['promo_fin_date'];
$percentage = $_POST['promo_pourcent'];

$sql = "INSERT INTO promo(reference, start_date, end_date, percentage) VALUES(:reference, :start_date, :end_date, :percentage)";

$req = $bdd->prepare($sql);
$req->execute(array(
   'reference' => $reference,
   'start_date' => $start_date,
   'end_date' => $end_date,
   'percentage' => $percentage
));

$req_ref_name = $bdd->prepare('SELECT name from reference WHERE id = ?');
$req_ref_name->execute(array($reference));
$ref_name = $req_ref_name->fetch()['name'];
header("Location: /admin/?type=promo&error=false&name=" . $ref_name);

?>