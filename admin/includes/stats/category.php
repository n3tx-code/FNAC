<?php

/*if(!isset($_POST['category']) OR empty($_POST['category']))
{
    header('location: ' . $_SERVER['HTTP_REFERER']);
}*/

include ('../../../includes/bdd.php');

$category = ''; //$_POST['category'];

$map = array();

$sql = 'SELECT id FROM reference WHERE category = "'.$category.'"';
$req = $bdd->query($sql);

while($res = $req->fetch())
{
    $id = $res['id'];
    $sql = 'SELECT COUNT(*) FROM product WHERE reference = '.$id;
    $count = $bdd->query($sql)->fetchColumn();
    $map[$id] = $count;
}

asort($map);

var_dump($map);

?>