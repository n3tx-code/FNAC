<?php

/*if(!isset($_POST['shop']) OR empty($_POST['shop']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}*/

include ('../../../includes/bdd.php');

$shop_id = 'ml'; //$_POST['shop'];

$sql = 'SELECT * FROM shop WHERE identifiant = "'.$shop_id.'"';

$shop_data = $bdd->query($sql)->fetch();

$map = array();

$sql = 'SELECT * FROM stock WHERE shop = "'.$shop_id.'"';
$stock = $bdd->query($sql);

while($data = $stock->fetch())
{
    $reference = $data['reference'];
    $sql = 'SELECT COUNT(*) FROM product WHERE reference = '.$reference;
    $count = $bdd->query($sql)->fetchColumn();
    $map[$reference] = $count;
}

foreach($map as $key => $value)
{
    echo $key . " : " . $value;
}

?>